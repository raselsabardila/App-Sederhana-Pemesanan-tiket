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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::post("/kind/search","KindController@search")->name("kind.search");
Route::resource("/kind","KindController");

Route::post("/categori/import/store","CategoryController@excel")->name("category.excel");
Route::get("/category/import","CategoryController@import")->name("category.import");
Route::post("/category/search","CategoryController@search")->name("category.search");
Route::resource("/category","CategoryController");

Route::post("/tiket/search","TiketController@search")->name("tiket.search");
Route::resource("/tiket","TiketController");

Route::get("/transaksi/excel","TransaksiController@excel")->name("transaksi.excel");
Route::get("/transaksi/selesai","TransaksiController@selesai")->name("transaksi.selesai");
Route::get("/transaksi/pdf","TransaksiController@laporan")->name("transaksi.laporan");
Route::resource("/transaksi","TransaksiController");


