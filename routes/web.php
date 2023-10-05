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

Route::get('/', function () {
    return redirect()->route('pasien.create');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::post('/pasien/post', 'App\Http\Controllers\MasterPasienController@store')->name('pasien.store');
Route::get('/daftar', 'App\Http\Controllers\MasterPasienController@create')->name('pasien.create');
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    //Route User
    Route::get('/user','App\Http\Controllers\UserController@user')->name('user.index');
    Route::post('/user-post','App\Http\Controllers\UserController@store')->name('user.store');
    Route::post('/user-post/{id}','App\Http\Controllers\UserController@update')->name('user.update');
    Route::delete('/user-hapus/{id}','App\Http\Controllers\UserController@destroy')->name('user.destroy');

    // Pasien
    Route::get('/pasien', 'App\Http\Controllers\MasterPasienController@index')->name('pasien.index');
    Route::post('/pasien/edit/{id}', 'App\Http\Controllers\MasterPasienController@edit')->name('pasien.edit');
    Route::delete('/pasien/delete/{id}','App\Http\Controllers\MasterPasienController@destroy')->name('pasien.destroy');
    Route::post('/pasien/tanggal','App\Http\Controllers\MasterPasienController@filter')->name('pasien.filter');

    //Layanan
    Route::get('/layanan', 'App\Http\Controllers\MasterLayananController@index')->name('layanan.index');
    Route::post('/layanan/post', 'App\Http\Controllers\MasterLayananController@store')->name('layanan.store');
    Route::post('/layanan/edit/{id}', 'App\Http\Controllers\MasterLayananController@edit')->name('layanan.edit');
    Route::delete('/layanan/delete/{id}','App\Http\Controllers\MasterLayananController@destroy')->name('layanan.destroy');
    Route::post('/layanan/tanggal','App\Http\Controllers\MasterLayananController@filter')->name('layanan.filter');

    //Jenis Pendaftaran
    Route::get('/jenis_pendaftaran', 'App\Http\Controllers\MasterJenisPendaftaranController@index')->name('jenis_pendaftaran.index');
    Route::post('/jenis_pendaftaran/post', 'App\Http\Controllers\MasterJenisPendaftaranController@store')->name('jenis_pendaftaran.store');
    Route::post('/jenis_pendaftaran/edit/{id}', 'App\Http\Controllers\MasterJenisPendaftaranController@edit')->name('jenis_pendaftaran.edit');
    Route::delete('/jenis_pendaftaran/delete/{id}','App\Http\Controllers\MasterJenisPendaftaranController@destroy')->name('jenis_pendaftaran.destroy');
    Route::post('/jenis_pendaftaran/tanggal','App\Http\Controllers\MasterJenisPendaftaranController@filter')->name('jenis_pendaftaran.filter');

    //Petugas
    Route::get('/petugas', 'App\Http\Controllers\MasterPetugasController@index')->name('petugas.index');
    Route::post('/petugas/post', 'App\Http\Controllers\MasterPetugasController@store')->name('petugas.store');
    Route::post('/petugas/edit/{id}', 'App\Http\Controllers\MasterPetugasController@edit')->name('petugas.edit');
    Route::delete('/petugas/delete/{id}','App\Http\Controllers\MasterPetugasController@destroy')->name('petugas.destroy');
    Route::post('/petugas/tanggal','App\Http\Controllers\MasterPetugasController@filter')->name('petugas.filter');

    //Metode Pembayaran
    Route::get('/metode_pembayaran', 'App\Http\Controllers\MasterMetodePembayaranController@index')->name('metode_pembayaran.index');
    Route::post('/metode_pembayaran/post', 'App\Http\Controllers\MasterMetodePembayaranController@store')->name('metode_pembayaran.store');
    Route::post('/metode_pembayaran/edit/{id}', 'App\Http\Controllers\MasterMetodePembayaranController@edit')->name('metode_pembayaran.edit');
    Route::delete('/metode_pembayaran/delete/{id}','App\Http\Controllers\MasterMetodePembayaranController@destroy')->name('metode_pembayaran.destroy');
    Route::post('/metode_pembayaran/tanggal','App\Http\Controllers\MasterMetodePembayaranController@filter')->name('metode_pembayaran.filter');

    //Transaksi Registasi
    Route::get('/registrasi', 'App\Http\Controllers\TrxRegistrasiController@index')->name('registrasi.index');
    Route::post('/registrasi/post', 'App\Http\Controllers\TrxRegistrasiController@store')->name('registrasi.store');
    Route::post('/registrasi/edit/{id}', 'App\Http\Controllers\TrxRegistrasiController@edit')->name('registrasi.edit');
    Route::delete('/registrasi/delete/{id}','App\Http\Controllers\TrxRegistrasiController@destroy')->name('registrasi.destroy');
    Route::post('/registrasi/tanggal','App\Http\Controllers\TrxRegistrasiController@filter')->name('registrasi.filter');

    //Metode Pelayanan
    Route::get('/pelayanan', 'App\Http\Controllers\TrxPelayananController@index')->name('pelayanan.index');
    Route::post('/pelayanan/post', 'App\Http\Controllers\TrxPelayananController@store')->name('pelayanan.store');
    Route::post('/pelayanan/edit/{id}', 'App\Http\Controllers\TrxPelayananController@edit')->name('pelayanan.edit');
    Route::delete('/pelayanan/delete/{id}','App\Http\Controllers\TrxPelayananController@destroy')->name('pelayanan.destroy');
    Route::post('/pelayanan/tanggal','App\Http\Controllers\TrxPelayananController@filter')->name('pelayanan.filter');

    //Pelayanan Publik
    Route::get('/pelayanan/confirm/{id}', 'App\Http\Controllers\TrxPelayananController@confirm')->name('pelayanan.confirm');
    Route::get('/pelayanan/mulai/{id}', 'App\Http\Controllers\TrxPelayananController@mulai')->name('pelayanan.mulai');
    Route::get('/pelayanan/selesai/{id}', 'App\Http\Controllers\TrxPelayananController@selesai')->name('pelayanan.selesai');
    Route::post('/pelayanan/payment/{id}', 'App\Http\Controllers\TrxPelayananController@payment')->name('pelayanan.payment');
});

