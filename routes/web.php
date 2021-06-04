<?php

use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('index');
    });

    Route::group(['middleware' => 'AdminMiddleware'], function () {
    });

    Route::group(['middleware' => 'BendaharaMiddleware'], function () {
        //transaksi
        Route::post('bendahara/simpan', 'BendaharaController@store')->name('simpanbendahara');
        Route::get('bendahara/edit/{id}', 'BendaharaController@edit')->name('editbendahara');
        Route::post('bendahara/update', 'BendaharaController@update')->name('updatebendahara');
        Route::delete('bendahara/delete/{id}', 'BendaharaController@destroy')->name('deletebendahara');
        //pjk
        Route::get('bendahara/pjk', 'BendaharaController@pjk')->name('bendaharaPjk');
        Route::post('bendahara/insertpjk', 'BendaharaController@insertpjk')->name('insertpjk');
        Route::get('bendahara/addpjk', 'BendaharaController@addpjk')->name('addpjk');
        Route::delete('bendahara/deletepjk/{id}', 'BendaharaController@destroypjk')->name('deletepjk');
        Route::get('bendahara/editpjk/{id}', 'BendaharaController@editpjk')->name('editpjk');
        Route::get('bendahara/updatepjk/{id}', 'BendaharaController@updatepjk')->name('updatepjk');
    });
    Route::group(['middleware' => 'KalabMiddleware'], function () {
        Route::get('kalab/verif/{id}', 'KalabController@verif')->name('verif');
        Route::get('kalab/unverif/{id}', 'KalabController@unverif')->name('unverif');
        Route::get('/crud', 'AdminController@index')->name('crud');
        Route::post('crud/simpan', 'AdminController@store')->name('simpan');
        Route::delete('crud/delete/{id}', 'AdminController@destroy')->name('delete');
        Route::get('crud/edit/{id}', 'AdminController@edit')->name('edit');
        Route::PATCH('crud/update/{id}', 'AdminController@update')->name('edit');
    });
    Route::get('bendahara/home', 'BendaharaController@index')->name('bendaharaHome');
    Route::get('bendahara/dashboard', 'BendaharaController@dashboard')->name('bendaharaDashboard');
    Route::post('bendahara/filter', 'BendaharaController@filter')->name('filterbendahara');
    Route::get('bendahara/detailpjk/{id}', 'BendaharaController@detailpjk')->name('detailpjk');
    Route::get('koordinator/reportpjk', 'BendaharaController@pjk')->name('reportpjk');
    Route::get('bendahara/detail/{id}', 'BendaharaController@detail')->name('detailbendahara');
    Route::get('bendahara/exportpjk/{id}', 'BendaharaController@exportpjk')->name('exportpjk');
});

Route::post('/login', 'autentikasi\AutentikasiController@login')->name('login');
Route::get('/', 'autentikasi\AutentikasiController@indexlogin')->name('indexlogin');
Route::get('/logout', 'autentikasi\AutentikasiController@logout')->name('logout');
