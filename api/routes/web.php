<?php

use App\Http\Controllers\AdminController;
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

Route::get('/login',[AdminController::class,'loginForm'])->name('auth.loginForm');
Route::get('/logout',[AdminController::class, 'logout'])->name('auth.logout');
Route::post('/login',[AdminController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');

    Route::prefix('/usuarios')->group(function () {
        Route::get('/', [AdminController::class, 'listadoUsuarios'])->name('usuarios');
    });

    Route::prefix('/noticias')->group(function () {
        Route::get('/', [AdminController::class, 'listadoNoticias'])->name('noticias');
        Route::get('/agregar', [AdminController::class, 'noticiaForm'])->name('noticias.crearForm');
        Route::post('/crear', [AdminController::class, 'crear'])->name('noticias.crear');
    });
});
