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

        Route::match(['get', 'put'],'/verificar/{usuario}', [AdminController::class,'verificarUsuario'])->name('usuarios.verificar');
        Route::match(['get', 'delete'],'/eliminar/{usuario}', [AdminController::class,'usuarioEliminar'])->name('usuarios.eliminar');

        Route::get('/restaurar/{usuario}', [AdminController::class, 'usuarioRestaurar'])->name('usuarios.restaurar');
    });

    Route::prefix('/noticias')->group(function () {
        Route::get('/', [AdminController::class, 'listadoNoticias'])->name('noticias');
        Route::get('/agregar', [AdminController::class, 'noticiaForm'])->name('noticias.crearForm');
        Route::get('/detalle/{noticia}', [AdminController::class, 'detalle'])->name('noticias.detalle');
        Route::get('/editar/{noticia}', [AdminController::class, 'editarForm'])->name('noticias.editarForm');

        Route::post('/crear', [AdminController::class, 'crear'])->name('noticias.crear');

        Route::put('/editar/{noticia}', [AdminController::class,'editar'])->name('noticias.editar');

        Route::match(['get', 'delete'],'/eliminar/{noticia}', [AdminController::class,'eliminar'])->name('noticias.eliminar');
    });

    Route::prefix('/eventos')->group(function () {
        Route::get('/', [AdminController::class, 'listadoEventos'])->name('eventos');

        Route::get('/detalle/{evento}', [AdminController::class, 'detalleEvento'])->name('eventos.detalle');

        Route::delete('/eliminar/{evento}', [AdminController::class, 'eliminarEvento'])->name('eventos.eliminar');
        Route::get('/restaurar/{evento}', [AdminController::class, 'eventosDesbloquear'])->name('eventos.restaurar');
    });

    Route::prefix('/alertas')->group(function () {
        Route::get('/', [AdminController::class, 'listadoAlertas'])->name('alertas');
    });
});
