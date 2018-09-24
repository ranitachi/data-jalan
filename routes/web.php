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

Route::get('/', 'Frontend\DashboardController@index')->name('utama');

Route::get('hasil-usulan', 'UsulanVerifikasiController@usulan')->name('hasil.usulan');

Route::get('hasil-verifikasi', 'UsulanVerifikasiController@verifikasi')->name('hasil.verifikasi');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/readcsv', 'RumahkumuhController@readcsv')->name('home');

Route::get('dashboard', 'Backend\DashboardController')->name('dashboard')->middleware('auth');

Route::get('user-management', 'Backend\UserManagementController')->name('user.management')->middleware('auth');

Route::resource('usulan', 'Backend\UsulanController')->middleware('auth');

Route::get('usulan/{id}/delete', 'Backend\UsulanController@delete')->middleware('auth');

Route::get('data-kumuh/{kecamatan}','RumahkumuhController@datakumuh')->name('datakumuh.kecamatan');

Route::resource('verifikasi', 'Backend\VerifiedController')->middleware('auth');

Route::get('verifikasi/{id}/delete', 'Backend\VerifiedController@delete')->middleware('auth');

Route::get('data-kumuh-json','RumahkumuhController@datakumuhjson')->name('datakumuhjson.kecamatan');

Route::get('detail-data-kumuh/{kecamatan}','RumahkumuhController@detail')->name('detail.kecamatan');

Route::get('detail-data-kumuh-kelurahan/{kecamatan}/{kelurahan}','RumahkumuhController@detailkelurahan')->name('detail.kelurahan');

Route::get('kategori-admin','TrxBeritaKategoriController@index')->middleware('auth');

Route::resource('berita-admin','TrxBeritaController',[ 'only' => ['index', 'create', 'store','edit'] ])->middleware('auth');

Route::resource('berita','Frontend\BeritaController',[ 'only' => ['index', 'show'] ]);

Route::get('show/{slug}','Frontend\BeritaController@detail');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     //\UniSharp\LaravelFilemanager\Lfm::routes();
 });