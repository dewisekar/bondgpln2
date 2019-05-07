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

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/test', 'AdminController@test');

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/input-bondg', 'AdminController@showform_bondg');
Route::get('/input-ap2t', 'AdminController@showform_ap2t');
Route::get('/bondg', 'AdminController@status_bondg');
Route::post('/bondg', 'AdminController@filter_bondg');
Route::post('/input-bondg', 'AdminController@input_bondg');
Route::post('/detail-bondg', 'AdminController@detail_bondg');
Route::post('/hapus-bondg', 'AdminController@hapus_bondg');
Route::post('/edit-bondg/{id}', 'AdminController@edit_bondg');
Route::post('/input-ap2t', 'AdminController@search_bondg');
Route::post('/tambah-ap2t', 'AdminController@input_ap2t');
Route::get('/register-akun', 'AdminController@showform_akun');
Route::post('/register-akun', 'AdminController@register_akun');
Route::get('/daftar-akun', 'AdminController@akun');
Route::post('/aktifkan-akun', 'AdminController@activate_akun');
Route::get('/input-petugas', 'AdminController@showform_petugas');
Route::post('/input-petugas', 'AdminController@search_bondg_2');
Route::post('/tambah-petugas', 'AdminController@tambah_petugas');
Route::get('/remaja', 'AdminController@show_remaja');

Route::get('/status-order', 'ViewerController@show_status');