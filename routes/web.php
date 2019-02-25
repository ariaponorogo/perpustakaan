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
    return view('auth.login');
});

Route::group(['middleware' => ['isAdmin']], function() {

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    //dashboard
    Route::get('/dashboard','dashcontrol@index');
    Route::get('/dashboard','dashcontrol@search');

    //Anggota
    Route::get('/anggota/add','AnggotaControl@add');
    Route::post('/anggota/save','AnggotaControl@save');
    Route::get('/anggota/edit/{kd_anggota}','AnggotaControl@edit');
    Route::post('/anggota/update','AnggotaControl@update');
    Route::get('/anggota/delete/{id}','AnggotaControl@delete');
    Route::get('/anggota/cetak/{id}','cetakControl@cetak');

    //Pengarang
    Route::get('/pengarang/add','PengarangControl@add');
    Route::post('/pengarang/save','PengarangControl@save');
    Route::get('/pengarang/delete/{id}','PengarangControl@delete');
    Route::get('/pengarang/edit/{id}','PengarangControl@edit');
    Route::post('/pengarang/update','PengarangControl@update');
    Route::get('/report/kartu_anggota/{id}','ReportControl@cetak');

    //Penerbit
    Route::get('/penerbit/add','PenerbitControl@add');
    Route::post('/penerbit/save','PenerbitControl@save');
    Route::get('/penerbit/delete/{id}','PenerbitControl@delete');
    Route::get('/penerbit/edit/{id}','PenerbitControl@edit');
    Route::post('/penerbit/update','PenerbitControl@update');

    //Rak
    Route::get('/rak/add','RakControl@add');
    Route::post('/rak/save','RakControl@save');
    Route::get('/rak/delete/{id}','RakControl@delete');
    Route::get('/rak/edit/{kd_rak}','RakControl@edit');
    Route::post('/rak/update','RakControl@update');

    //Buku
    Route::get('/buku/add','BukuControl@add');
    Route::post('/buku/save','BukuControl@save');
    Route::get('/buku/delete/{id}','BukuControl@delete');
    Route::get('/buku/edit/{id}','BukuControl@edit');

    //Koleksi
    Route::get('/koleksi/add','KoleksiControl@add');
    Route::post('/koleksi/save','KoleksiControl@save');
    Route::get('/koleksi/delete/{id}','KoleksiControl@delete');
    Route::get('/koleksi/edit/{id}','KoleksiControl@edit');
    Route::post('/koleksi/update','KoleksiControl@update');

    //Peminjaman
    Route::post('/trans/peminjaman','TransaksiControl@peminjaman');
    Route::get('/trans/peminjaman','TransaksiControl@peminjaman');
    Route::post('/trans/peminjaman/save','TransaksiControl@save_peminjaman');

    //pengembalian
    Route::post('/trans/pengembalian','TransaksiControl@pengembalian');
    Route::get('/trans/pengembalian','TransaksiControl@pengembalian');
    Route::post('/trans/pengembalian/save','TransaksiControl@save_peminjaman');

    //KATEGORI
    Route::get('/kategori','KategoriControl@index');
    Route::get('/kategori/add','KategoriControl@add');
    Route::post('/kategori/save','KategoriControl@save');
    Route::get('/kategori/edit/{kd_kategori}','KategoriControl@edit');
    Route::post('/kategori/update','KategoriControl@update');
    Route::get('/kategori/delete/{id}','KategoriControl@delete');

    //Report
    Route::get('/report/anggota','ReportControl@rpt_anggota');
    Route::get('/report/qrcode_buku','ReportControl@rpt_QRCode_Buku');
    Route::get('/report/qrcode_anggota','ReportControl@QR_Code_Anggota');

    Route::get('report/cetak_anggota','ReportControl@cetak_anggota');

    //your routes
    Route::get('user','UserControl@index');
    Route::get('user/add','UserControl@add');
    Route::get('user/edit/{id}','UserControl@edit');
    Route::post('user/save','UserControl@save');

});

Route::group(['middleware' => ['isOperator']], function(){

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    //dashboard
    Route::get('/dashboard','dashcontrol@index');
    //anggota
    Route::get('/anggota','AnggotaControl@index');
    //buku
    Route::get('/buku','BukuControl@index');
    //koleksi
    Route::get('/koleksi','KoleksiControl@index');
    //pengarang
    Route::get('/pengarang','PengarangControl@index');
    //penerbit
    Route::get('/penerbit','PenerbitControl@index');
    //rak
    Route::get('/rak','RakControl@index');
    //transaksi
    Route::get('/trans/peminjaman','TransaksiControl@peminjaman');
    Route::post('/trans/peminjaman','TransaksiControl@peminjaman');
    Route::post('/trans/peminjaman/save','TransaksiControl@save');

    Route::post('/trans/pengembalian','TransaksiControl@pengembalian');
    Route::get('/trans/pengembalian','TransaksiControl@pengembalian');
    Route::post('/trans/pengembalian/save','TransaksiControl@save_pengembalian');

    Route::get('/report/qrcode_buku','ReportControl@rpt_QRCode_Buku');
    Route::get('/report/qrcode_anggota','ReportControl@QR_Code_Anggota');

    Route::get('/report/cetak','ReportControl@cetak');
    Route::get('/report/cetak_anggota','ReportControl@cetak_anggota');
});

Auth::routes();

Route::get('/cetak',function(){
    return view('cetak_kartu');
});

