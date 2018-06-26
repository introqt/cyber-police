<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ClientPageController@index');
Route::post('/clientMakesOrder', 'ClientPageController@makeOrder');

//Auth::routes();

// группа путей URL для админки
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
    // дальше подразумевается, что все пути начинаются с САЙТ/admin/тут_сущность
    // например для последней строки объявленный путь будет таким:
    // site.com/admin/services
    // все остальные пути ларавел обработает из коробки пакета Backpack
], function () {
    CRUD::resource('positions', 'PositionCrudController');
    CRUD::resource('workers', 'WorkerCrudController');
    CRUD::resource('departments', 'DepartmentCrudController');
});
Route::get('/home', 'AdminPageController@index')->name('home');
