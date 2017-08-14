<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Blog\Models\Categories;
use App\Modules\Blog\Models\Post;
use App\Modules\Blog\Models\User;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * [__construct]
     */
    public function __construct()
    {
        $categories = Categories::all();
        view()->share('categories', $categories);

    }

    /**
     * show home
     * 
     * @return view
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('Blog::pages.home',compact('posts'));
    }

    /**
     * view contact
     * 
     * @return view
     */
    public function contact()
    {
        return view('Blog::pages.contact');
    }

    /**
     * about blog
     * 
     * @return view
     */
    public function about()
    {
        return view('Blog::pages.about');
    }

    /**
     * show post by category
     * 
     * @param  int $id
     * @return view
     */
    public function category($id)
    {
        $categories = Categories::find($id);
        $posts = $categories->posts()->simplePaginate(10);
        return view('Blog::pages.category', ['categori' => $categories, 'posts' => $posts]);
    }

    /**
     * detail post
     * 
     * @param  int $id
     * @return view
     */
    public function detail($id)
    {
        $post = Post::find($id);
        $idUser = $post->user_id;
        $user = User::find($idUser);
        $hotNews = Post::orderBy('soluotxem', 'desc')->take(2)->get();
        return view('Blog::pages.detail', ['post'=>$post, 'user' => $user, 'hotNews' => $hotNews]);
    }

    /**
     * info user
     * 
     * @return view
     */
    public function getUser()
    {
        return view('Blog::pages.user');
    }

    /**
     * edit info user
     * 
     * @param  Request $request
     * @return view
     */
    public function postUser(Request $request)
    {
        $user = Auth::user();
        $messages = [
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.max'      => 'Tên người dùng phải có độ dài 3 - 100 kí tự',
            'name.min'      => 'Tên người dùng phải có độ dài 3 - 100 kí tự',
        ];
        $rules = [
            'name' => 'required|min:3|max:100',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try {
            $user->name = $request->name;
            if ($request->checkpassword == 'on') {
                $this->validate($request, [
                        'password' => 'required|min:1|max:60',
                        're_password' => 'required|same:password',
                    ],
                    [
                        'password.required' => 'Trường mật khẩu không được để trống',
                        'password.min'      => 'Mật khẩu phải có độ dài từ 10 - 60 ký tự',
                        'password.max'      => 'Mật khẩu phải có độ dài từ 10 - 60 ký tự',
                        're_password.required' => 'Trường nhập lại mật khẩu còn trống',
                        're_password.same'     => 'Mật khẩu nhập lại không trùng',
                    ]);
                $user->password = bcrypt($request->password);
            }
            $user->save();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }

        return redirect('user')->with('thongbao', 'Sửa thành công');
    }

    /**
     * show form register member
     * 
     * @return view
     */
    public function getRegister()
    {
        return view('Blog::pages.register');
    }

    /**
     * handle register
     * 
     * @param  Request $request
     * @return view
     */
    public function postRegister(Request $request)
    {
        $messages = [
            'txtName.required'     => 'Bạn chưa nhập tên chuyên mục',
            'txtName.max'          => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
            'txtName.min'          => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
            'txtEmail.required'    => 'Trường email còn trống',
            'txtEmail.unique'      => 'Đã tồn tại email',
            'txtEmail.email'       => 'Không đúng định dạng email',
            'txtPassword.required' => 'Trường mật khẩu không được để trống',
            'txtPassword.min'      => 'Mật khẩu phải có độ dài từ 10 - 60 ký tự',
            'txtPassword.max'      => 'Mật khẩu phải có độ dài từ 10 - 60 ký tự',
            'passwordAgain.required' => 'Trường nhập lại mật khẩu còn trống',
            'passwordAgain.same'     => 'Mật khẩu nhập lại không trùng',
        ];
        $rules = [
            'txtName'     => 'required|min:3|max:100',
            'txtEmail'    => 'required|unique:users,email|email',
            'txtPassword' => 'required|min:1|max:60',
            'passwordAgain' => 'required|same:txtPassword',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user           = new User;
        $user->name     = $request->txtName;
        $user->email    = $request->txtEmail;
        $user->password = bcrypt($request->txtPassword);
        $user->quyen    = 0;
        $user->save();

        return redirect('register')->with('thongbao', "Đăng ký thành công");
    }

    /**
     * search post
     * 
     * @param  Request $request 
     * @return view
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $posts = Post::where('tieude', 'like', "%$keyword%")->simplePaginate(5);
        return view('Blog::pages.search', ['posts'=>$posts, 'keyword' => $keyword]);
    }

    /**
     * get posts by user
     * 
     * @param  int $id
     * @return view
     */
    public function getPostUser($id)
    {
        $user = User::find($id);
        $posts = $user->getPostByUser()->simplePaginate(10);
        // dd($posts);
        return view('Blog::pages.postsByUser', ['posts'=>$posts, 'user'=>$user]);

    }
}
