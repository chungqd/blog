<?php 
Route::group(['namespace' => 'App\Modules\Blog\Controllers', 'middleware'=>'web'], function () {

    Route::get('login', "UserController@getLogin");
    Route::post('login', "UserController@postLogin");
    Route::get('logout', "UserController@logout");

    Route::group(['prefix' => 'admin' ,'middleware' => 'checklogin'], function (){
        Route::get('home', 'HomeController@HomeView');

        Route::group(['prefix' => 'user'], function() {
            Route::get('list', 'UserController@index')->name('ds_user');

            Route::get('add', 'UserController@getAdd');
            Route::post('add', 'UserController@postAdd');

            Route::get('edit/{id}', 'UserController@getEdit');
            Route::post('edit/{id}', 'UserController@postEdit');

            Route::get('delete/{id}', 'UserController@delete');
        });

        Route::group(['prefix' => 'categories'], function() {
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

            Route::get('edit', 'PostController@edit');
        });
    });
});