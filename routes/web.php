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

Route::get('/', 'PagesController@index')->name('main');
Route::get('rules', 'PagesController@rules')->name('rules');
Route::get('language', 'PagesController@localization');

Route::prefix('account')->group(function () {
    Route::get('/', 'AccountController@index');
    Route::post('/', 'AccountController@change');
    Route::get('/change', 'AccountController@show');
    Route::get('/change/password', 'AccountController@password');
    Route::get('/management', 'AccountController@management_index');
    Route::post('/management', 'AccountController@management_change_permissions');
});

Auth::routes(['verify' => true]);

Route::get('/uploads/{also_delete_graduate}/{type}/{name}', 'UploadsController@index')->where('name', '.*')->middleware('can:show,also_delete_graduate');

Route::prefix('graduates')->group(function () {
    Route::get('/deleted', 'GraduatesController@showDeleted');
    Route::post('/deleted', 'GraduatesController@restore');
    Route::delete('/deleted', 'GraduatesController@forceDelete');
});

Route::prefix('{graduate}/uploads')->group(function () {
    Route::post('/deleted', 'GraduatesController@restoreFiles');
});

Route::resource('graduates', 'GraduatesController');
