<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KabupatenKotaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\ParticipantController;

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

// Route::get('/', 'AuthController@index')->name('login');
// Route::post('post-login', 'AuthController@postLogin')->name('post-login'); 
// Route::get('dashboard', 'AuthController@dashboard')->name('dashboard'); 
// Route::get('logout', 'AuthController@logout');
Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'AuthController@dashboard')->name('home');
    Route::get('dashboard', 'AuthController@dashboard')->name('dashboard');
    Route::get('logout', 'AuthController@logout')->name('logout');
 	
 	Route::resource('provinsi', 'ProvinsiController');
	Route::resource('kabupaten-kota', 'KabupatenKotaController');
	Route::resource('kecamatan', 'KecamatanController');
	Route::resource('kelurahan', 'KelurahanController');
	Route::resource('participant', 'ParticipantController');

	Route::get('/participant/create/provinsi/{id}', [ParticipantController::class, 'getKabupatenKota']);
	Route::get('/participant/create/kab/{id}', [ParticipantController::class, 'getKecamatan']);
	Route::get('/participant/create/kecamatan/{id}', [ParticipantController::class, 'getKelurahan']);
});