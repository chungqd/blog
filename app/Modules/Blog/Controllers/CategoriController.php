<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Blog\Models\Categories;
use App\Http\Requests;
use App\Http\Requests\StoreBlogPostRequest;
use DB;


class CategoriController extends Controller
{
    /**
     * show list categori
     * 
     * @return [view]
     */
    public function index()
    {
        $categories = Categories::paginate(5);
        return view('Blog::admin.categories.index', ['categories'=>$categories]);
    }

    /**
     * show view add categori
     * 
     * @return [view]
     */
    public function getAdd()
    {
        return view('Blog::admin.categories.addCategories');
    }

    /**
     * add new category
     *
     * @param Request $request
     * @return [view]
     */
    public function postAdd(Request $request)
    {
        $messages = [
                'txtName.required' => 'Bạn chưa nhập tên chuyên mục',
                'txtName.unique' => 'Tên chuyên mục đã tồn tại',
                'txtName.max' => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
                'txtName.min' => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
        ];
        $rules = [
            'txtName' => 'required|unique:categories,ten|min:3|max:100',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $categories = new Categories;
        $categories->ten = $request->txtName;
        $categories->tenkhongdau = str_slug($request->txtName);
        $categories->save();
        return redirect('admin/categories/list')->with('thongbao', "Thêm thành công");
    }

    /**
     * show view edit category
     *
     * @param int $id
     * @return [view]
     */
    public function getEdit($id)
    {
        $categories = Categories::find($id);
        if (empty($categories)) {
            return redirect('admin/categories/list')->with('mess', 'Không tồn tại thể loại cần sửa');
        } else {
            return view('Blog::admin.categories.editCategories', ['categories' => $categories]);
        }
    }

    /**
     * edit category
     *
     * @param Request $request
     * @param int $id
     * @return [view]
     * @throws \Exception
     */
    public function postEdit(Request $request, $id)
    {
        $categories = Categories::find($id);
        if (empty($categories)) {
            return redirect('admin/categories/list')->with('mess', 'Không tồn tại chuyên mục cần sửa');
        }

        if ($request->txtName === $request->hddName) {
            return redirect('admin/categories/list')->with('thongbao', "Sửa thành công");
        } 

        $messages = [
            'txtName.required' => 'Bạn chưa nhập tên chuyên mục',
            'txtName.unique' => 'Tên chuyên mục đã tồn tại',
            'txtName.max' => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
            'txtName.min' => 'Tên chuyên mục phải có độ dài 3 - 100 kí tự',
        ];
        $rules = [
            'txtName' => 'required|unique:categories,ten|min:3|max:100',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try {
            $categories->ten = $request->txtName;
            $categories->tenkhongdau = str_slug($request->txtName);
            $categories->save();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }

        return redirect('admin/categories/list')->with('thongbao', "Sửa thành công");
    }

    /**
     * delete category
     *
     * @param int $id
     * @return [view]
     */
    public function delete($id)
    {
        $categories = Categories::find($id);
        if (empty($categories)) {
            return redirect('admin/categories/list')->with('mess', 'Không tồn tại chuyên mục cần xóa');
        }

        $categories->delete();
        return redirect('admin/categories/list')->with('thongbao', "Xóa thành công");
    }

    public function search($keyword)
    {
        $categories = Categories::where('ten', 'like', "%$keyword%")->simplePaginate(5);
        if ($categories) {
            return view('Blog::admin.categories.list', ['categories'=>$categories]);
        }
        return view('errors.403');
    }
}
