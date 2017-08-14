<?php 
Route::group(['namespace' => 'App\Modules\Blog\Controllers', 'middleware'=>'web'], function () {

    Route::get('login', "UserController@getLogin");
    Route::post('login', "UserController@postLogin");
    Route::get('logout', "UserController@logout");
    Route::get('home', 'HomeController@index');
    Route::get('contact', 'HomeController@contact');
    Route::get('about', 'HomeController@about');
    Route::get('category/{id}/{TenKhongDau}.html', 'HomeController@category');
    Route::get('detail/{id}/{TenKhongDau}.html', 'HomeController@detail');
    Route::get('user', 'HomeController@getUser')->middleware('checklogin');
    Route::post('user', 'HomeController@postUser');
    Route::get('register', 'HomeController@getRegister');
    Route::post('register', 'HomeController@postRegister');

    Route::post('search', 'HomeController@search');


    Route::group(['prefix' => 'admin' ,'middleware' => 'checklogin'], function (){
        Route::get('home', function(){
            return view('Blog::admin.home');
        });

        Route::group(['prefix' => 'user','middleware' => 'policies'], function() {
            Route::get('list', 'UserController@index')->name('ds_user');

            Route::get('add', 'UserController@getAdd');
            Route::post('add', 'UserController@postAdd');

            Route::get('edit/{id}', 'UserController@getEdit');
            Route::post('edit/{id}', 'UserController@postEdit');

            Route::get('delete/{id}', 'UserController@delete');
        });


        Route::group(['prefix' => 'categories','middleware' => 'policies'], function() {
            Route::get('list', 'CategoriController@index');

            Route::get('add', 'CategoriController@getAdd');
            Route::post('add', 'CategoriController@postAdd');

            Route::get('edit/{id}', 'CategoriController@getEdit');
            Route::post('edit/{id}', 'CategoriController@postEdit');

            Route::get('delete/{id}', 'CategoriController@delete');
        });
    
        Route::group(['prefix' => 'post'], function() {
            Route::get('list', 'PostController@index');

            Route::get('add', 'PostController@getAdd');
            Route::post('add', 'PostController@postAdd');

            Route::get('edit/{id}', 'PostController@getEdit');
            Route::post('edit/{id}', 'PostController@postEdit');

            Route::get('delete/{id}', 'PostController@delete');
        });
    });
});