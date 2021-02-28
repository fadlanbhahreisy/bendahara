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
        Route::get('/crud', 'AdminController@index')->name('crud');
        Route::post('crud/simpan', 'AdminController@store')->name('simpan');
        Route::delete('crud/delete/{id}', 'AdminController@destroy')->name('delete');
        Route::get('crud/edit/{id}', 'AdminController@edit')->name('edit');
        Route::PATCH('crud/update/{id}', 'AdminController@update')->name('edit');
    });

    Route::group(['middleware' => 'BendaharaMiddleware'], function () {
        Route::get('bendahara/home', 'BendaharaController@index')->name('bendaharaHome');
        Route::post('bendahara/simpan', 'BendaharaController@store')->name('simpanbendahara');
        Route::get('bendahara/edit/{id}', 'BendaharaController@edit')->name('editbendahara');
        Route::post('bendahara/update', 'BendaharaController@update')->name('updatebendahara');
        Route::delete('bendahara/delete/{id}', 'BendaharaController@destroy')->name('deletebendahara');
        Route::get('bendahara/search', 'BendaharaController@search')->name('searchbendahara');
        Route::post('/bendahara/fetch', 'BendaharaController@fetch')->name('bendahara.fetch');
        Route::get('bendahara/detail/{id}', 'BendaharaController@detail')->name('detailbendahara');
    });
    Route::group(['middleware' => 'KoordinatorMiddleware'], function () {
        Route::get('koordinator/home', 'KoordinatorController@index')->name('koordinatorHome');
        Route::post('koordinator/simpan', 'KoordinatorController@store')->name('simpankoordinator');
        Route::get('koordinator/report', 'BendaharaController@index')->name('report');
        Route::delete('koordinator/delete/{id}', 'KoordinatorController@destroy')->name('deletekoordinator');
        Route::get('koordinator/edit/{id}', 'KoordinatorController@edit')->name('editkoordinator');
        Route::post('koordinator/update', 'KoordinatorController@update')->name('updatekoordinator');
        Route::post('/autocomplete/fetch', 'KoordinatorController@fetch')->name('autocomplete.fetch');
        Route::get('koordinator/search', 'KoordinatorController@search')->name('searchkoordinator');
        Route::get('koordinator/detail/{id}', 'KoordinatorController@detail')->name('detailkoordinator');
    });
});

Route::post('/login', 'autentikasi\AutentikasiController@login')->name('login');
Route::get('/', 'autentikasi\AutentikasiController@indexlogin')->name('indexlogin');
Route::get('/logout', 'autentikasi\AutentikasiController@logout')->name('logout');
