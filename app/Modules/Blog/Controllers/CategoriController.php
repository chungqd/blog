<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Blog\Models\Categories;
use App\Http\Requests;
use App\Http\Requests\StoreBlogPostRequest;

class CategoriController extends Controller
{
    public function index()
    {
    	$categories = Categories::paginate(5);
    	return view('Blog::admin.categories.index', ['categories'=>$categories]);
    }

    public function showAdd()
    {
    	return view('Blog::admin.categories.addCategories');
    }

    public function add(Request $request)
    {
    	// $this->validate($request, 
    	// 	['txtName'=>'required|min:3|max:100'],
    	// 	[
    	// 		'txtName.required' => 'Bạn chưa nhập tên chuyên mục',
    			// 'txtName.unique' => 'Tên chuyên mục da ton tai',
    	// 		'txtName.min' => "Tên chuyên mục phải có độ dài 3 - 100 kí tự",
    	// 		'txtName.max' => "Tên chuyên mục phải có độ dài 3 - 100 kí tự",
    	// 	]
    	// );

    	// $vali = Validator::make($request->all(), ['txtName' => 'required|max:255']);
    	// if ($vali->fails()) {
    	// 	return view('Blog::admin.categories.addCategories')->withErrors($vali);
    	// }
    	$categories = new Categories;
    	$categories->ten = $request->txtName;
    	$categories->tenkhongdau = str_slug($request->txtName);
    	$categories->save();
    	return redirect('admin/categories/add')->with('thongbao', "Thêm thành công");
    }

    public function getEdit($id)
    {
    	$categories = Categories::find($id);
    	// var_dump(empty($categories));
    	if (empty($categories)) {
    		$categories = Categories::paginate(5);
    		return view('Blog::admin.categories.index', ['categories'=> $categories,'mess' => 'Không có thể loại']);
    	}else{
	    	// echo $categories->ten; die();
	    	return view('Blog::admin.categories.editCategories', ['categories' => $categories]);
    	}
    }

    public function postEdit(Request $request, $id)
    {
    	$categories = Categories::find($id);
    	$this->validate($request,
    		['txtName' => 'required|unique:categories, ten|min:3|max:100'],
    		[
    			'txtName.required' => 'Bạn chưa nhập tên chuyên mục',
    			'txtName.unique' => 'Tên chuyên mục da ton tai',
    			'txtName.min' => "Tên chuyên mục phải có độ dài 3 - 100 kí tự",
    			'txtName.max' => "Tên chuyên mục phải có độ dài 3 - 100 kí tự",
    		]
    	);

  //   	$validator = Validator::make(
	 //        array('name'=>$request->txtName),
	 //        array('name' => array('required', 'min:5'))
  //   	);

  //   	if($validator->fails())
		// {
		//     // Các dữ liệu không pass qua validation
		//     $messages = $validator->messages();
		//     return view('Blog::admin.categories.editCategories', ['catogeries'=>$categories, 'err' => $messages]);
		// }

    	$categories->ten = $request->txtName;
    	$categories->tenkhongdau = str_slug($request->txtName);
    	$categories->save();
    	return view('Blog::admin.categories.editCategories', ['categories' => $categories])->with('thongbao', "Sua thành công");
    }

    // function delete categories
    public function deleteCategorie($id)
    {
    	// $categories = Categories::find($id);
    	Categories::destroy($id);
    	return redirect('admin/categories/list')->with('thongbao', "Xoa thành công");
    }
}
