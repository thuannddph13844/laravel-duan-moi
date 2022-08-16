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
    // Route::get('/login', ['as'=>'login','uses'=>'Auth\LoginController@getLogin']);
});
Route::get('/', 'Client@viewCL') ->name('index');
Route::get('/detail/{id}', 'Client@detailsp');
Route::get('/cart', 'Client@viewCart');

Route::get('add-to-cart/{id}', 'Client@addtocart') ->name('route_Frondten_user_addToCart');
//admin
Route::get('/login', ['as'=>'login','uses'=>'Auth\LoginController@getLogin']);
Route::post('/login', ['as'=>'login','uses'=>'Auth\LoginController@postLogin']);
Route::middleware(['auth'])->group(function(){
    Route::get('/user', 'UserController@listUser');
   //danh muc
    Route::get('/danhmuc', 'DanhmucController@listDanhmuc');
//san pham
    Route::get('/sanpham', 'SanphamController@ListSanpham');
    Route::get('/sanpham/detail/{prod_id}', 'SanphamController@detail')->name('route_BackEnd_Sanpham_Detail');
    Route::post('/sanpham/detail/{prod_id}', 'SanphamController@update')->name('route_Backend_Sanpham_Update');
    Route::get('/sanpham/delete/{prod_id}', 'SanphamController@delete');

    Route::match(['get', 'post'], '/sanpham/add', 'SanphamController@addSp')->name('route_BackEnd_Sanpham_Add');
    //khuyen mai
    Route::get('/khuyenmai', 'KhuyenmaiController@listSell');
//hoa don
    Route::get('/hoadon', 'HoadonController@listHoadon');
//size
    Route::get('/size', 'SizeController@listSize');
    Route::get('/Chi_tiet_size', 'Ct_sizeController@listCtSize');
    Route::match(['get', 'post'], '/Chi_tiet_size/add', 'Ct_sizeController@addCtSize')->name('route_BackEnd_CtSize_Add');

    Route::match(['get', 'post'], '/size/add', 'SizeController@addSize')->name('route_BackEnd_Size_Add');
//coloer
    Route::get('/color', 'SizeController@listSize');

    Route::get('/chi_tiet_hoadon', 'Chi_tiet_htController@chiTietHt');
});
