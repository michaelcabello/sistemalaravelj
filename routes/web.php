<?php

use App\Http\Controllers\CategoriaController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| joffre me la mama bien riko dkjasfbasghfasfhjasfasfahksdl
*/

Route::get('/', function () {
    return view('contenido.contenido');
})->middleware('auth');;

Route::get('categoria', 'CategoriaController@index');
Route::post('categoria/registrar', 'CategoriaController@store');
Route::put('categoria/actualizar', 'CategoriaController@update');
Route::put('categoria/desactivar', 'CategoriaController@desactivar');
Route::put('categoria/activar', 'CategoriaController@activar');
Route::get('categoria/selectCategoria', 'CategoriaController@selectCategoria');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
