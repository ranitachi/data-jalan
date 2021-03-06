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

Route::get('/jumlah-ruas-jalan', 'ApiForDashboardController@jumlah_ruas_jalan');
Route::get('/data-kondisi-jalan', 'ApiForDashboardController@data_kondisi_jalan');
Route::get('/total-konstruksi-jalan', 'ApiForDashboardController@total_konstruksi_jalan');
Route::get('/data-jalan-all', 'ApiForDashboardController@all_data_jalan');

Route::get('/data-irigasi-by-kecamatan', 'ApiForDashboardController@data_irigasi_by_kecamatan');
Route::get('/all-data-irigasi', 'ApiForDashboardController@all_data_irigasi');
Route::get('/data-irigasi-total', 'ApiForDashboardController@data_irigasi_total');

Route::get('/data-jembatan-per-kecamatan', 'ApiForDashboardController@data_jembatan_per_kecamatan');
Route::get('/data-jembatan-all', 'ApiForDashboardController@data_jembatan_all');
Route::get('/data-jembatan-count', 'ApiForDashboardController@data_jembatan_count');

Route::get('/data-situ-count', 'ApiForDashboardController@data_situ_count');
Route::get('/data-situ-all', 'ApiForDashboardController@data_situ_all');
Route::get('/data-situ-per-kecamatan', 'ApiForDashboardController@data_situ_per_kecamatan');

Route::get('/data-sungai-count', 'ApiForDashboardController@data_sungai_count');
Route::get('/data-sungai-all', 'ApiForDashboardController@data_sungai_all');
Route::get('/data-sungai-per-kali', 'ApiForDashboardController@data_sungai_per_kali');
Route::get('/data-sungai-per-kecamatan', 'ApiForDashboardController@data_sungai_per_kecamatan');
Route::get('/data-sungai-per-jenis', 'ApiForDashboardController@data_sungai_per_jenis');

Route::get('welcome', 'HomeController@welcome')->name('utama');
Route::get('/', 'Frontend\DashboardController@index')->name('utama');

Route::get('hasil-usulan', 'UsulanVerifikasiController@usulan')->name('hasil.usulan');
Route::get('datairigasi', 'DataSituController@datairigasi')->name('hasil.usulan');

Route::get('hasil-verifikasi', 'UsulanVerifikasiController@verifikasi')->name('hasil.verifikasi');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/readcsv', 'RumahkumuhController@readcsv')->name('home');

Route::get('dashboard', 'Backend\DashboardController')->name('dashboard')->middleware('auth');

Route::get('user-management', 'Backend\UserManagementController')->name('user.management')->middleware('auth');

Route::resource('usulan', 'Backend\UsulanController')->middleware('auth');

Route::get('usulan/{id}/delete', 'Backend\UsulanController@delete')->middleware('auth');

Route::get('data-kumuh/{kecamatan}','RumahkumuhController@datakumuh')->name('datakumuh.kecamatan');
Route::get('data-jalan/{kecamatan}','DataJalanController@jumlahruasjalan')->name('datajalan.kecamatan');
Route::get('detail-data/{kecamatan}','DataJalanController@datajalan')->name('detail.jalan');
Route::get('detail-ruas-jalan/{ruas}','DataJalanController@dataruasjalan')->name('detail.ruas');
Route::get('load_data', 'DataJalanController@load_data')->name('load.data');
Route::get('load-map/{id}', 'DataJalanController@load_maps')->name('load.map');
Route::get('json_kml_jalan', 'DataJalanController@json_kml_jalan')->name('load.json_kml_jalan');
Route::post('upload_kml', 'DataJalanController@upload_kml')->name('upload_kml');

Route::get('detail-data-irigasi/{kecamatan}','DataIrigasiController@datairigasi')->name('detail.irigasi');
Route::get('detail-data-situ/{kecamatan}','DataSituController@datasitu')->name('detail.situ');
Route::get('detail-data-jembatan/{kecamatan}','DataJembatanController@datajembatan')->name('detail.jembatan');
Route::get('detail-data-sungai/{kecamatan}','DataSungaiController@datasungai')->name('detail.sungai');
Route::get('cek-jembatan','DataJembatanController@cek');

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

Route::resource('all-data-jalan', 'BackendDataJalanController')->middleware('auth');
Route::get('all-data-jalan/delete/{id}', 'BackendDataJalanController@destroy')->middleware('auth');
Route::get('data-jalan-kondisi/{id}', 'BackendDataJalanController@kondisi');

Route::resource('all-irigasi', 'BackendIrigasiController')->middleware('auth');
Route::get('all-irigasi/delete/{id}', 'BackendIrigasiController@destroy')->middleware('auth');

Route::resource('all-situ', 'BackendSituController')->middleware('auth');
Route::get('all-situ/delete/{id}', 'BackendSituController@destroy')->middleware('auth');

Route::resource('all-sungai', 'BackendSungaiController')->middleware('auth');
Route::get('all-sungai/delete/{id}', 'BackendSungaiController@destroy')->middleware('auth');

Route::resource('all-jembatan', 'BackendJembatanController')->middleware('auth');
Route::get('all-jembatan/delete/{id}', 'BackendJembatanController@destroy')->middleware('auth');

Route::get('download-file/{jenis}','Backend\DashboardController@download_file')->middleware('auth');

Route::get('view-tabular-jalan', 'DataJalanController@view_tabular_jalan')->name('view_tabular_jalan');
Route::get('view-tabular-irigasi', 'DataIrigasiController@view_tabular_irigasi')->name('view_tabular_irigasi');
Route::get('view-tabular-situ', 'DataSituController@view_tabular_situ')->name('view_tabular_situ');
Route::get('view-tabular-sungai', 'DataSungaiController@view_tabular_sungai')->name('view_tabular_sungai');
Route::get('view-tabular-jembatan', 'DataJembatanController@view_tabular_jembatan')->name('view_tabular_jembatan');
