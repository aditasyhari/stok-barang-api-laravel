<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\Auth\AuthController@register');
Route::post('login', 'Api\Auth\AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('data-pembeli/riwayat', 'Api\riwayat_pembeli\RiwayatPembeliController@indexAll');
    
    Route::resource('/stok-barang', 'Api\stok_barang\stok_barangController');
    Route::resource('/data-pembeli', 'Api\data_pembeli\DataPembeliController');

    Route::get('data-pembeli/{id}/riwayat', 'Api\riwayat_pembeli\RiwayatPembeliController@index');
    Route::put('data-pembeli/{id}/riwayat/{id_riwayat}', 'Api\riwayat_pembeli\RiwayatPembeliController@update');
    Route::get('data-pembeli/riwayat/{id}', 'Api\riwayat_pembeli\RiwayatPembeliController@show');
    Route::post('data-pembeli/{id}/riwayat', 'Api\riwayat_pembeli\RiwayatPembeliController@store');
    Route::delete('data-pembeli/riwayat/{id}', 'Api\riwayat_pembeli\RiwayatPembeliController@destroy');

});



