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
    return view('welcome');
});

Route::prefix('rest')->group(function () {
    Route::resource('user',     'Rest\\UserController');
    Route::resource('empresa',  'Rest\\EmpresaController');
    Route::resource('setor',    'Rest\\SetorController');
    Route::resource('subsetor', 'Rest\\SubsetorController');
    Route::resource('segmento', 'Rest\\SegmentoController');
    Route::resource('indice',   'Rest\\IndiceController');
    Route::resource('ativo',    'Rest\\AtivoController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
