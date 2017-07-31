<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Modules\Blog\Models\User;


class UserController extends Controller
{
    public function index()
    {
    	$user = User::paginate(5);
    	return view('Blog::admin.users.index', ['user'=>$user]);
    }

    public function getAdd()
    {
    	return view('Blog::admin.users.addUser');
    }

    public function postAdd(Request $request)
    {
    	$user = new User;
    	$user->name = $request->txtName;
    	$user->email = $request->txtEmail;
    	$user->password = bcrypt($request->txtPassword);
    	$user->quyen = $request->slcRole;
    	$user->save();

    	// TODO validate

    	$user = User::paginate(5);
    	session()->put('mess', "Thêm thành công");
		return view('Blog::admin.users.index', ['user'=> $user,'mess' => session('mess')]);
    	// return redirect('admin/user/add')->with('thongbao', "Thêm thành công");
    }
    // TODO edit user
    public function getEdit($id)
    {
    	$user = User::find($id);
    	if (empty($user)) {
    		session()->put('thongbao', "Không tồn tại thành viên");
    		$user = User::paginate(5);
    		return view('Blog::admin.users.index', ['user'=> $user,'thongbao' => session('thongbao')]);
    	}else{
	    	// echo $user->ten; die();
	    	return view('Blog::admin.users.editUser', ['user' => $user]);
    	}
    }

    public function postEdit(Request $request, $id)
    {
    	$user = User::find($id);
    	if (empty($user)) {
    		session()->put('thongbao', "Không tồn tại thành viên");
    		$user = User::paginate(5);
    		return view('Blog::admin.users.index', ['user'=> $user,'thongbao' => session('thongbao')]);
    	}else{
    		$user->name = $request->txtName;
    		$user->email = $request->txtEmail;
    		$user->quyen = $request->slcRole;
    		$user->save();

    		$user = User::paginate(5);
    		session()->put('mess', "Sửa thành công");
	    	return view('Blog::admin.users.index', ['user' => $user, 'mess' => session('mess')]);
    	}
    }

    // delete Member
    public function deleteUser($id)
    {
    	$user = User::find($id);
    	if (empty($user)) {
    		session()->put('mess', "Không tồn tại thành viên");

    		$user = User::paginate(5);
    		return view('Blog::admin.users.index', ['user'=> $user,'mess' => session('mess')]);
    	}else
    	{
    		$user->delete();
    		$user = User::paginate(5);

    		session()->put('mess', "Xóa thành công");
    		return view('Blog::admin.users.index', ['user'=> $user,'mess' => session('mess')]);
    		// return redirect('admin/user/list')->with('thongbao', "Xóa thành công");
    	}
    }
}
