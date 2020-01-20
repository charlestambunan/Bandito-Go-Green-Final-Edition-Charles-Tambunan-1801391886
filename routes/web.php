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

//Masuk ke halaman homepages
Route::get('/','BerandaController@indeks');

//13.2. Menampilkan barang terbaru di Homepage untuk Guest
Route::get('/product', 'BerandaController@produk');
Route::get('/product/{categoryId}', 'BerandaController@produkKategori');

//Routing melakukan login ke admin dan routingan untuk memasukkan kategori, update kategori dan menghapus kategori
Route::get('/category/admin/','KategoriController@indeks');
Route::get('/category/admin/delete/{id}','KategoriController@hapus');
Route::get('/category/admin/detail/{id}','KategoriController@detil');
Route::post('/category/admin/add','KategoriController@buat');
Route::post('/category/admin/update/','KategoriController@ubah');

//Routing untuk melakukan manage transaksi pada halaman admin dan memverifikasi pembayaran buyer oleh admin tersebut
Route::get('/transaction/admin/','TransaksiController@indeks');

Route::get('/transaction/admin/approved/{code}','TransaksiController@setuju');

//checkout
Route::post('/checkout','TransaksiController@periksa');

//Menampilkan Detail Produk - Frontend
Route::get('/product/detail/{id}', 'BerandaController@detil');

//Menampilkan Detail Penjual dan Buyer
Route::get('seller','BerandaController@seller');

//Menampilkan Detail User
Route::get('penjual/{id}', 'BerandaController@detilSeller');

//untuk membuat controller halaman login untuk seller dan buyer
Route::get('auth/register','AuthController@register');
Route::post('auth/register/create','AuthController@create');


//untuk menyimpan controller halaman login untuk seller dan buyer
Route::post('auth/register','AuthController@store')->name('home.register');

//untuk membuat routing login aplikasi dan logout aplikasi
Route::post('auth/login', 'AuthController@login');
Route::get('auth/logout', 'AuthController@logout');


//Cart Belanjaan
Route::post('/cart', 'CartController@indeks');
Route::get('keranjang', 'CartController@keranjang');
Route::post('cart/update', 'CartController@ubah');
Route::get('cart/delete/{rowid}', 'CartController@hapus');

//Untuk Membuat Routingan untuk mengisi Formulir Setelah Memasukkan Belanjaan
Route::get('cart/formulir/{code}', 'CartController@formulir');

Route::post('cart/transaction', 'CartController@transaksi');

//Untuk Menampilkan Hasil Belanjaan yang belum lunas
Route::get('cart/myorder', 'CartController@orderSaya');

//Untuk Menampilkan Hasil Belanjaan yang belum lunas secara detail
Route::get('cart/detail/{code}', 'CartController@detil');

//Untuk Menampilkan Hasil Belanjaan yang lunas dan belum lunas secara detail
Route::get('/history', 'CartController@sejarah');


//Seller
Route::get('myproduct', 'CartController@produk')->middleware('oauth:seller');
Route::get('addproduct', 'CartController@tambahProduk');
Route::post('addproduct', 'CartController@simpanProduk');
Route::get('editproduct/{id}', 'CartController@ubahProduk');
Route::post('editproduct', 'CartController@ubahProduk2');
Route::get('deleteproduct/{id}', 'CartController@hapusProduk');

//untuk masuk ke dalam profil pribadi
Route::get('myprofil', 'BerandaController@profilSaya');

//untuk melakukan update profil si buyer, seller dan admin
Route::post('updateprofil', 'BerandaController@ubahProfil');

//Routing untuk keluar dari halaman buyer dan seller
Route::get('logout', 'BerandaController@keluar');

//untuk mengecek riwayat transaksi buyer dan seller / history transaction buyer dan seller

///Routing melakukan login ke admin dan melakukan insert kota, update kota dan delete kota yang sudah ada
Route::get('/city/admin', 'KotaController@indeks');
Route::get('/city/admin/delete/{id}','KotaController@hapus');
Route::get('/city/admin/detail/{id}','KotaController@detail');
Route::post('/city/admin/add','KotaController@buat');
Route::post('/city/admin/update/','KotaController@ubah');




Auth::routes();
