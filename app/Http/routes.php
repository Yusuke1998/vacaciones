<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


Route::get('autor',function(){
    return [
        "Autor"=>"Jhonny Perez",
        "Correo"=>"jhonnyjose1998@gmail.com",
    ];
})->name('autor');


Route::group(['middleware' => ['ajax']], function () {
    Route::post('worker/state', 'ApiController@state');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@welcome');
    Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
    Route::post('/home', 'HomeController@index')->name('index');
    Route::get('/home', 'HomeController@index');

    // TRABAJADORES
    Route::get('/worker/create', 'WorkerController@create');
    Route::post('/worker/store', 'WorkerController@store');
    Route::post('/worker/upload',  ['as' => 'worker.upload', 'uses' => 'WorkerController@upload']);
    Route::get('/worker/show/{id_worker}', 'WorkerController@show');
    Route::get('/worker/edit/{id_worker}', 'WorkerController@edit');
    Route::post('/worker/update', 'WorkerController@update');
    Route::get('/worker/retirados', 'WorkerController@retirados');
    Route::post('/worker/retirados', 'WorkerController@retirados')->name('index.retirados');
    Route::post('/worker/remove', 'WorkerController@remove');

    // USUARIOS
    Route::get('/usuario', 'UserController@index')->name('usuario.listar');
    Route::get('/usuario/create', 'UserController@create')->name('usuario.crear');
    Route::get('/usuario/edit/{id}', 'UserController@edit')->name('usuario.editar');
    Route::get('/usuario/delete/{id}', 'UserController@destroy')->name('usuario.eliminar');
    Route::post('/usuario/store', 'UserController@store')->name('usuario.guardar');
    Route::post('/usuario/update/{id}', 'UserController@update')->name('usuario.actualizar');

    // AREAS
    Route::get('/area', 'AreaController@index');
    Route::get('/area/create', 'AreaController@create');
    Route::get('/area/edit/{id}', 'AreaController@edit');
    Route::post('/area/store', 'AreaController@store');
    Route::post('/area/update/{id}', 'AreaController@update');

    // VACACIONES
    Route::get('/vacation/create/{id_worker}/{name_worker}', 'VacationController@create');
    Route::post('/vacation/store', 'VacationController@store');
});

Route::group(['middleware' => ['api']], function () {
    Route::post('worker/state', 'ApiController@state');
});