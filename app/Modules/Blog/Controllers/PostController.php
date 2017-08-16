<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;

use App\Modules\Blog\Models\Categories;
use App\Modules\Blog\Models\Post;

use App\Modules\Blog\Models\User;
use DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {
	/**
	 * show list posts
	 *
	 * @return view
	 */
	public function index() {
		if (Auth::user()->quyen == 1) {
			$posts = Post::paginate(3);
			return view('Blog::admin.posts.index', ['posts' => $posts]);
		}
		$idUser = Auth::user()->id;
		$posts  = User::find($idUser)->postUser()->paginate(3);
		return view('Blog::admin.posts.index', ['posts' => $posts]);
	}

	/**
	 * show form add post
	 *
	 * @return view
	 */
	public function getAdd() {
		$categories = Categories::all();
		return view('Blog::admin.posts.addPost', ['categories' => $categories]);
	}

	/**
	 * add post
	 *
	 * @param  Request $request
	 * @return view
	 */
	public function postAdd(Request $request) {
		$messages = [
			'tieude.required' => 'Bạn chưa nhập tiêu đề',
			'tieude.min'      => 'Tiêu đề phải có độ dài 10 - 255 kí tự',
			'tieude.max'      => 'Tiêu đề phải có độ dài 10 - 255 kí tự',
			// 'tieude.unique'     => 'Tiêu đề đã tồn tại',
			'tomtat.required'   => 'Bạn chưa nhập nội dung tóm tắt',
			'tomtat.min'        => 'Nội dung tóm tắt phải có độ dài 10 - 255 kí tự',
			'tomtat.max'        => 'Nội dung tóm tắt phải có độ dài 10 - 255 kí tự',
			'noidung.required'  => 'Bạn chưa nhập nội dung',
			'noidung.min'       => 'Nội dung tối thiểu phải có 10 kí tự',
			'category.required' => 'Chưa chọn chuyên mục',
			'file.required'     => 'Chưa chọn hình ảnh',
			'file.image'        => 'Chưa đúng định dạng ảnh',
		];
		$rules = [
			'tieude'   => 'required|min:10|max:255',
			'tomtat'   => 'required|min:10|max:255',
			'noidung'  => 'required|min:10',
			'category' => 'required',
			'file'     => 'required|image',
		];
		$validator = Validator::make($request->all(), $rules, $messages);
		if ($validator    ->fails()) {
			return redirect()->back()
			                 ->withErrors($validator)
			                 ->withInput();
		}

		if ($request->hasFile('file')) {
			$file    = $request->file('file');
			$nameImg = str_random(3)."_".$file->getClientOriginalName();
			while (file_exists("uploads/".$nameImg)) {
				$nameImg = str_random(3)."_".$file->getClientOriginalName();
			}
			$file->move('uploads', $nameImg);
		}

		$idUser               = Auth::user()->id;
		$post                 = new Post;
		$post->tieude         = $request->tieude;
		$post->tieudekhongdau = str_slug($request->tieude);
		$post->tomtat         = $request->tomtat;
		$post->noidung        = $request->noidung;
		$post->HinhAnh        = $nameImg;
		$post->user_id        = $idUser;
		$post->save();

		// add post_cates table
		$idCategory = $request->category;
		$post->categories()->attach($idCategory);

		// $idPost = $post->id;
		// $cate = array();
		// foreach ($idCategory as $value) {
		//     $cate[] = ['post_id' => $idPost, 'cate_id'=> $value];
		// }
		// PostCate::insert($cate);
		return redirect('admin/post/list')->with('thongbao', "Thêm thành công");
	}

	/**
	 * edit post
	 *
	 * @param  int $id
	 * @return view
	 */
	public function getEdit($id) {
		$categories = Categories::all();
		$post       = Post::find($id);
		$idUser     = Auth::user()->id;

		if (empty($post)) {
			return redirect('admin/post/list')->with('mess', "Không tồn tại bài viết cần sửa");
		}

		$idUserOfPost = $post->user_id;
		if ($idUser == $idUserOfPost || Auth::user()->quyen == 1) {
			return view('Blog::admin.posts.editPost', ['post' => $post, 'categories' => $categories]);
		} else {
			return redirect('admin/post/list')->with('mess', "Không tồn tại bài viết cần sửa");
		}
	}

	/**
	 * handle edit post
	 *
	 * @param  Request $request
	 * @param  int  $id
	 * @return view
	 */
	public function postEdit(Request $request, $id) {
		$post   = Post::find($id);
		$idUser = Auth::user()->id;

		if (empty($post)) {
			return redirect('admin/post/list')->with('mess', "Không tồn tại bài viết cần sửa");
		}

		$idUserOfPost = $post->user_id;
		if ($idUser == $idUserOfPost || Auth::user()->quyen == 1) {
			$messages = [
				'tieude.required'   => 'Bạn chưa nhập tiêu đề',
				'tieude.min'        => 'Tiêu đề phải có độ dài 10 - 255 kí tự',
				'tieude.max'        => 'Tiêu đề phải có độ dài 10 - 255 kí tự',
				'tomtat.required'   => 'Bạn chưa nhập nội dung tóm tắt',
				'tomtat.min'        => 'Nội dung tóm tắt phải có độ dài 10 - 255 kí tự',
				'tomtat.max'        => 'Nội dung tóm tắt phải có độ dài 10 - 255 kí tự',
				'noidung.required'  => 'Bạn chưa nhập nội dung',
				'noidung.min'       => 'Nội dung tối thiểu phải có 10 kí tự',
				'category.required' => 'Chưa chọn chuyên mục',
				'file.image'        => 'Chưa đúng định dạng ảnh',
			];
			$rules = [
				'tieude'   => 'required|min:10|max:255',
				'tomtat'   => 'required|min:10|max:255',
				'noidung'  => 'required|min:10',
				'category' => 'required',
				'file'     => 'image',
			];
			$validator = Validator::make($request->all(), $rules, $messages);
			if ($validator    ->fails()) {
				return redirect()->back()
				                 ->withErrors($validator)
				                 ->withInput();
			}

			// upload image
			$nameImg = '';
			if ($request->hasFile('file')) {
				$file    = $request->file('file');
				$nameImg = str_random(3)."_".$file->getClientOriginalName();
				while (file_exists("uploads/".$nameImg)) {
					$nameImg = str_random(3)."_".$file->getClientOriginalName();
				}
				unlink("uploads/".$post->HinhAnh);
				$file->move('uploads', $nameImg);
			}

			//update post
			DB::beginTransaction();
			try {
				$post->tieude         = $request->tieude;
				$post->tieudekhongdau = str_slug($request->tieude);
				$post->tomtat         = $request->tomtat;
				$post->noidung        = $request->noidung;

				if (!empty($nameImg)) {
					$post->HinhAnh = $nameImg;
				}

				// update table post_cates
				$idCategory = $request->category;
				$post->categories()->sync($idCategory);

				$post->save();
				DB::commit();
			} catch (Exception $ex) {
				DB::rollback();
				throw $ex;
			}

			return redirect('admin/post/list')->with('thongbao', "Sửa bài viết thành công");
		} else {
			return redirect('admin/post/list')->with('mess', "Không tồn tại bài viết cần sửa");
		}
	}

	/**
	 * delete Post
	 *
	 * @param  int $id
	 * @return view
	 */
	public function delete($id) {
		$post         = Post::find($id);
		$idUser       = Auth::user()->id;
		$idUserOfPost = $post->user_id;

		if ($idUser == $idUserOfPost || Auth::user()->quyen == 1) {
			//delete in table post_cates
			$post->categories()->detach();

			// $categoryPost = PostCate::where('post_id', $id);
			// $categoryPost->delete();

			$post->delete();
			return redirect('admin/post/list')->with('thongbao', "Xóa thành công");
		} else {
			return redirect('admin/post/list')->with('mess', "Không tồn tại bài viết cần xóa");
		}
	}

	/**
	 * search post
	 *
	 * @param  Request $request
	 * @return view
	 */
	public function search($keyword) {
		$posts = Post::where('tieude', 'like', "%$keyword%")->simplePaginate(5);
		return view('Blog::admin.posts.index', ['posts' => $posts]);
	}
}
