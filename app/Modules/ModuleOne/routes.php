<?php 

/*
|--------------------------------------------------------------------------
| ModuleOne Module Routes
|--------------------------------------------------------------------------
|
| All the routes related to the ModuleOne module have to go in here. Make sure
| to change the namespace in case you decide to change the 
| namespace/structure of controllers.
|
*/
Route::group(['namespace' => 'App\Modules\ModuleOne\Controllers'], function () {
	Route::get('hello', ['as' => 'module-one.index', 'uses' => 'IndexController@index']);
	Route::get('model-test', ['as' => 'module-one.modelTest', 'uses' => 'IndexController@modelTest']);
	Route::get('test', function() {
	    return view('ModuleOne::dummy');
	});
});