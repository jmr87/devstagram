<?php

use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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
    return view('principal');
});

// Cuando creamos el controlador podemos quitar el name del post por que ya lo toma del get.

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/login', [LoginController::class ,'index'])->name('login');
Route::post('/login', [LoginController::class ,'store']);
Route::post('/logout', [LogoutController::class ,'store'])->name('logout');

// Al aplicar llaver al nombre de un módelo, como en este caso users. Aplicamos RouteModelBinding.
// Así Laravel hace automatícamente el trabajao de leer el parametro de la url y despues consultar el módelo.
Route::get('/{user:username}', [PostController::class ,'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class ,'create'])->name('posts.create');
Route::post('/posts', [PostController::class ,'store'])->name('posts.store');

Route::post('/imagenes', [ImagenController::class ,'store'])->name('imagenes.store');






