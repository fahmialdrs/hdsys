<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses'=>'Auth\AuthController@getLogin','as'=>'login']);

Route::get('logs',['uses'=>'\Rap2hpoutre\LaravelLogViewer\LogViewerController@index','as'=>'logs'] );

//Route::get('start',['uses'=>'SiteController@start']); do for first start to create role permission and user
Route::get('start',['uses'=>'SiteController@start']);


Route::get('login', ['uses'=>'Auth\AuthController@getLogin','as'=>'login']);
Route::get('auth/login', ['uses'=>'Auth\AuthController@getLogin','as'=>'login']);
Route::post('login', ['uses'=>'Auth\AuthController@postLogin','as'=>'doLogin']);
Route::get('logout', ['uses'=>'Auth\AuthController@getLogout','as'=>'logout']);
Route::get('dashboard', ['uses'=>'SiteController@dashboard','as'=>'dashboard']);
Route::get('home', ['uses'=>'SiteController@dashboard','as'=>'dashboard']);
Route::get('email/{id}', ['uses'=>'SiteController@sendEmail','as'=>'email']);


Route::controller('datatablestower', 'TowerController', [
    'getIndexData'  => 'datatablestower.data',
]);

Route::group(['prefix' => 'setting','as' => 'setting::'], function () {
        Route::get('backup', ['uses'=>'SiteController@backup','as'=>'backup']);
        Route::get('doBackup', ['uses'=>'SiteController@doBackup','as'=>'doBackup']);
        Route::get('restoreLastBackup', ['uses'=>'SiteController@restoreLastBackup','as'=>'restoreLastBackup']);
        Route::get('restore/{name}', ['uses'=>'SiteController@restore','as'=>'restore']);
        Route::get('deleteFile/{name}', ['uses'=>'SiteController@deleteFile','as'=>'deleteFile']);
        Route::get('download/{name}', ['uses'=>'SiteController@download','as'=>'download']);
});

Route::group(['prefix' => 'towers','as' => 'towers::'], function () {
    Route::get('create', ['as' => 'add', 'uses' => 'TowerController@create']); //task::add
    Route::get('index', ['as' => 'index', 'uses' => 'TowerController@index']); //task::store
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TowerController@edit']); //task::edit
    Route::get('view/{id}', ['as' => 'view', 'uses' => 'TowerController@show']); //task::view
    Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'TowerController@destroy']); //task::delete

    Route::post('store', ['as' => 'store', 'uses' => 'TowerController@store']); //task::store
    Route::put('update/{id}', ['as' => 'update', 'uses' => 'TowerController@update']); //task::update
});


Route::any('getTowers', ['as' => 'tower::fetch', 'uses' => 'TowerController@getTowers']);

Route::group(['prefix' => 'statistic','as' => 'statistic::'], function () {
    Route::get('ticketByMonth', ['as' => 'ticketByMonth', 'uses' => 'SiteController@ticketByMonth']);
});

Route::group(['prefix' => 'user','as' => 'user::'], function () {
	Route::get('create', ['as' => 'add', 'uses' => 'UserController@create']);
	Route::post('store', ['as' => 'store', 'uses' => 'UserController@store']);

	Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'UserController@destroy']);

	Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'UserController@edit']);
	Route::put('edit/{id}/update', ['as' => 'update', 'uses' => 'UserController@update']);

	Route::get('changePassword/{id}', ['as' => 'editPassword','uses' => 'UserController@editPassword']);
	Route::put('changePassword/{id}/update', ['as' => 'updatePassword', 'uses' => 'UserController@updatePassword']);

	Route::get('fetchUser', ['as' => 'fetch', 'uses' => 'UserController@throwUser']);
});

Route::group(['prefix' => 'category','as' => 'category::'], function () {
	Route::get('create', ['as' => 'add', 'uses' => 'CategoryController@create']);
	Route::post('store', ['as' => 'store', 'uses' => 'CategoryController@store']);

	Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'CategoryController@destroy']);

	Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CategoryController@edit']);
	Route::put('edit/{id}/update', ['as' => 'update', 'uses' => 'CategoryController@update']);
});

Route::group(['prefix' => 'tenant','as' => 'tenant::'], function () {
	Route::get('create', ['as' => 'add', 'uses' => 'TenantController@create']);
	Route::post('store', ['as' => 'store', 'uses' => 'TenantController@store']);

	Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'TenantController@destroy']);

	Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TenantController@edit']);
	Route::put('edit/{id}/update', ['as' => 'update', 'uses' => 'TenantController@update']);
});

Route::group(['prefix' => 'team','as' => 'team::'], function () {

    Route::get('create', ['as' => 'add', 'uses' => 'TeamController@create']);
    Route::get('index', ['as' => 'index', 'uses' => 'TeamController@index']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TeamController@edit']);
    Route::get('view/{id}', ['as' => 'view', 'uses' => 'TeamController@show']);
    Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'TeamController@destroy']);
    Route::get('fetchTeam', ['as' => 'fetch', 'uses' => 'TeamController@throwTeam']);

    Route::post('store', ['as' => 'store', 'uses' => 'TeamController@store']);
    Route::put('edit/{id}/update', ['as' => 'update', 'uses' => 'TeamController@update']);
});

Route::group(['prefix' => 'sla','as' => 'sla::'], function () {

    Route::get('create', ['as' => 'add', 'uses' => 'SLAController@create']);
    Route::get('index', ['as' => 'index', 'uses' => 'SLAController@index']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'SLAController@edit']);
    Route::get('view/{id}', ['as' => 'view', 'uses' => 'SLAController@show']);
    Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'SLAController@destroy']);

    Route::get('{id}/rules', ['as' => 'rules', 'uses' => 'SLAController@rules']);
     Route::get('/rules/delete/{id}', ['as' => 'deleteRules', 'uses' => 'SLAController@destroyRules']);
    Route::post('store', ['as' => 'store', 'uses' => 'SLAController@store']);
    Route::post('{id}/rules', ['as' => 'storeRules', 'uses' => 'SLAController@storeRules']);
    Route::put('edit/{id}/update', ['as' => 'update', 'uses' => 'SLAController@update']);

    Route::get('fetchSeverity/{id}', ['as' => 'fetchSeverity', 'uses' => 'SLAController@getSLARules']);
});

Route::group(['prefix' => 'ticket','as' => 'ticket::'], function () {

    Route::get('create', ['as' => 'add', 'uses' => 'TicketController@create']);
    Route::get('index/{status}', ['as' => 'indexStatus', 'uses' => 'TicketController@indexByStatus']);
    Route::get('index', ['as' => 'index', 'uses' => 'TicketController@index']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TicketController@edit']);
    Route::get('view/{id}', ['as' => 'view', 'uses' => 'TicketController@show']);
    Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'TicketController@destroy']);
    Route::get('changeStatus/{id}/{status}', ['as' => 'changeStatus', 'uses' => 'TicketController@changeStatus']);
    Route::get('generate/{id}', ['as' => 'generate', 'uses' => 'TicketController@generatePDF']);
    Route::post('store', ['as' => 'store', 'uses' => 'TicketController@store']);
    Route::put('edit/{id}/update', ['as' => 'update', 'uses' => 'TicketController@update']);

    Route::get('search', ['as' => 'search', 'uses' => 'TicketController@search']);
    Route::get('picStatusRespond/{id}', ['as' => 'picStatus', 'uses' => 'TicketController@picStatusRespond']);
    Route::get('picStatusRecover/{id}', ['as' => 'picStatus', 'uses' => 'TicketController@picStatusRecover']);
    Route::get('picStatusResolve/{id}', ['as' => 'picStatus', 'uses' => 'TicketController@picStatusResolve']);
    Route::get('picStatusClose/{id}', ['as' => 'picStatus', 'uses' => 'TicketController@picStatusClose']);
    Route::get('export',['as' => 'export', 'uses' => 'TicketController@export']);
});

Route::group(['prefix' => 'mitra','as' => 'mitra::'], function () {

    Route::get('create', ['as' => 'add', 'uses' => 'MitraController@create']);
    Route::get('index', ['as' => 'index', 'uses' => 'MitraController@index']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'MitraController@edit']);
    Route::get('view/{id}', ['as' => 'view', 'uses' => 'MitraController@show']);
    Route::get('delete/{id}', ['as' => 'delete', 'uses' => 'MitraController@destroy']);
    Route::get('fetchTeam', ['as' => 'fetch', 'uses' => 'MitraController@throwTeam']);

    Route::post('store', ['as' => 'store', 'uses' => 'MitraController@store']);
    Route::put('edit/{id}/update', ['as' => 'update', 'uses' => 'MitraController@update']);

    Route::get('fetchMitra', ['as' => 'fetch', 'uses' => 'MitraController@getMitra']);
});
