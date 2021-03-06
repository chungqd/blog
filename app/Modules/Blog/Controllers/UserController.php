<?php
namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;

use App\Modules\Blog\Models\User;
use App\Modules\Blog\Models\Post;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    /**
     * show list user
     *
     * @return [view]
     */
    public function index() {
        $user = User::paginate(5);
        return view('Blog::admin.users.index', ['user' => $user]);
    }

    /**
     * show view add user
     *
     * @return [view]
     */
    public function getAdd() {
        return view('Blog::admin.users.addUser');
    }

    /**
     * add new user
     *
     * @param  Request $request
     * @return [view]
     */
    public function postAdd(Request $request) {
        $messages = [
            'txtName.required'     => 'Bạn chưa nhập tên chuyên mục',
            'txtName.max'          => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
            'txtName.min'          => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
            'txtEmail.required'    => 'Trường email còn trống',
            'txtEmail.unique'      => 'Đã tồn tại email',
            'txtEmail.email'       => 'Không đúng định dạng email',
            'txtPassword.required' => 'Trường mật khẩu không được để trống',
            'txtPassword.min'      => 'Mật khẩu phải có độ dài từ 6 - 60 ký tự',
            'txtPassword.max'      => 'Mật khẩu phải có độ dài từ 6 - 60 ký tự',
            're-password.required' => 'Trường nhập lại mật khẩu còn trống',
            're-password.same'     => 'Mật khẩu nhập lại không trùng',
        ];
        $rules = [
            'txtName'     => 'required|min:3|max:100',
            'txtEmail'    => 'required|unique:users,email|email',
            'txtPassword' => 'required|min:6|max:60',
            're-password' => 'required|same:txtPassword',
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
        $user->quyen    = $request->slcRole;
        $user->save();

        return redirect('admin/user/list')->with('thongbao', "Thêm thành công");
    }

    /**
     * show view edit user
     *
     * @param int $id
     * @return [view]
     */
    public function getEdit($id) {
        $user = User::find($id);
        if (empty($user)) {
            return redirect('admin/user/list')->with('mess', 'Không tồn tại thành viên cần sửa');
        } else {
            return view('Blog::admin.users.editUser', ['user' => $user]);
        }
    }

    /**
     * edit user
     *
     * @param  Request $request
     * @param  int  $id
     * @return [view]
     */
    public function postEdit(Request $request, $id) {
        $user = User::find($id);

        if (empty($user)) {
            return redirect('admin/user/list')->with('mess', 'Không tồn tại thành viên cần sửa');
        }

        $messages = [
            'txtName.required' => 'Bạn chưa nhập tên người dùng',
            'txtName.max'      => 'Tên người dùng phải có độ dài 3 - 100 kí tự',
            'txtName.min'      => 'Tên người dùng phải có độ dài 3 - 100 kí tự',
        ];
        $rules = [
            'txtName' => 'required|min:3|max:100',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try {
            $user->name  = $request->txtName;
            $user->quyen = $request->slcRole;
            if ($request->changePass == 'on') {
                $this->validate($request, [
                        'txtPassword' => 'required|min:6|max:60',
                        're-password' => 'required|same:txtPassword',
                    ],
                    [
                        'txtPassword.required' => 'Trường mật khẩu không được để trống',
                        'txtPassword.min'      => 'Mật khẩu phải có độ dài từ 6 - 60 ký tự',
                        'txtPassword.max'      => 'Mật khẩu phải có độ dài từ 6 - 60 ký tự',
                        're-password.required' => 'Trường nhập lại mật khẩu còn trống',
                        're-password.same'     => 'Mật khẩu nhập lại không trùng',
                    ]);
                $user->password = bcrypt($request->txtPassword);
            }
            $user->save();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }

        return redirect('admin/user/list')->with('thongbao', 'Sửa thành công');
    }

    /**
     * delete Member
     *
     * @param  [int] $id
     * @return view
     */
    public function delete($id) {
        $user = User::find($id);
        if (empty($user)) {
            return redirect('admin/user/list')->with('mess', 'Không tồn tại thành viên cần xóa');
        }
        $post = Post::where('user_id', $id)->count();
        if ($post == 0) {
            $user->delete();
            return redirect('admin/user/list')->with('thongbao', "Xóa thành công");
        } else {
            echo "<script type='text/javascript'>
                alert('Xin lỗi! Bạn phải xóa bài viết của thành viên trước');
                window.location = '";
                    echo route('ds_user');
            echo "'</script>";
        }

    }

    /**
     * show view login
     *
     * @return view
     */
    public function getLogin() {
        return view('Blog::login');
    }

    /**
     * handle login
     * @param  Request $request
     * @return view
     */
    public function postLogin(Request $request) {
        $this->validate($request, [
                'txtTenDangNhap' => 'required',
                'txtMatKhau' => 'required',
            ],
            [
                'txtTenDangNhap.required' => 'Tên đăng nhập không được để trống',
                'txtMatKhau.required' => 'Mật khẩu không được để trống',
            ]);

        if (Auth::attempt(['name' => $request->txtTenDangNhap, 'password' => $request->txtMatKhau, 'status' => 1])) {
            return redirect('home');
        } elseif (Auth::attempt(['name' => $request->txtTenDangNhap, 'password' => $request->txtMatKhau, 'status' => 0])) {
            return redirect('login')->with('error', 'Tài khoản chưa được kích hoạt');
        } else {
            return redirect('login')->with('error', 'Sai tên đăng nhập hoặc mật khẩu');
        }
    }

    /**
     * logout
     *
     * @return view
     */
    public function logout() {
        Auth::logout();
        return redirect('home');
    }

    /**
     * search post
     * 
     * @param  Request $request 
     * @return view
     */
    public function search($keyword)
    {
        $user = User::where('name', 'like', "%$keyword%")->orWhere('email', 'like', "%$keyword%")->simplePaginate(5);
        return view('Blog::admin.users.index', ['user'=>$user]);
    }
}
