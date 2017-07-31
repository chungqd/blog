<?php

namespace App\Modules\Blog\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function HomeView()
    {
    	return view('Blog::admin.home');
    	// return view('Blog::admin.categories.index');
    	// return view('Blog::admin.categories.addCategories');
    	// return view('Blog::admin.categories.editCategories');
    }
}
