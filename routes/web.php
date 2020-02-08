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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('home', 'HomeController@index')->name('home');

    require(__DIR__ . '/backend/master.php');
});

Route::get('sidang', 'ThesisTrialController@index')->name('sidang.index');
Route::get('sidang/add', 'ThesisTrialController@create')->name('sidang.create');
Route::post('sidang', 'ThesisTrialController@store')->name('sidang.store');
Route::get('sidang/show', 'ThesisTrialController@show')->name('sidang.detail');
Route::get('sidang/{id}/edit', 'ThesisTrialController@edit')->name('sidang.edit');
Route::patch('sidang', 'ThesisTrialController@update')->name('sidang.update');
Route::delete('sidang/{id}', 'ThesisTrialController@delete')->name('sidang.delete');

Route::get('sidang/nilai/{id}', 'ThesisTrialController@nilai')->name('sidang.nilai');
// Route::post('sidang/nilai', 'ThesisTrialController@setNilai')->name('sidang.setnilai');