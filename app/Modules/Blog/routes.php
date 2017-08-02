<?php 
use App\Modules\Blog\Models\Categories;
Route::group(['namespace' => 'App\Modules\Blog\Controllers'], function () {

    Route::get('login', "UserController@getLogin");
    Route::post('login', "UserController@postLogin");
    Route::get('logout', "UserController@logout");

    Route::group(['prefix' => 'admin'], function (){
        View::share('userss', Auth::user());
	    Route::get('home', 'HomeController@HomeView');

	    Route::group(['prefix' => 'user'], function() {
            Route::get('list', 'UserController@index');

            Route::get('add', 'UserController@getAdd');
            Route::post('add', 'UserController@postAdd');

            Route::get('edit/{id}', 'UserController@getEdit')->name('edit');
            Route::post('edit/{id}', 'UserController@postEdit');

            Route::get('delete/{id}', 'UserController@deleteUser');
	    });

	    Route::group(['prefix' => 'categories'], function() {
            Route::get('list', 'CategoriController@index');

            Route::get('add', 'CategoriController@showAdd');
            Route::post('add', 'CategoriController@add');

            Route::get('edit/{id}', 'CategoriController@getEdit');
            Route::post('edit/{id}', 'CategoriController@postEdit');

            Route::get('delete/{id}', 'CategoriController@deleteCategorie');
	    });
	
	    Route::group(['prefix' => 'post'], function() {
            Route::get('list', 'PostConttroller@index');

            Route::get('add', 'PostConttroller@add');

            Route::get('edit', 'PostConttroller@edit');
	    });
    });
});