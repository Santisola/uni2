<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetsController;
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

Route::get('/recuperar-contrasena', [PasswordResetsController::class, 'updatePasswordForm']);

Route::post('/login',[AdminController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');

    // Verificados
    Route::prefix('/verificados')->group(function () {
        Route::get('/', [AdminController::class, 'listadoVerificados'])->name('verificados');

        Route::match(['get', 'put'],'/verificar/{usuario}', [AdminController::class,'verificarUsuario'])->name('verificados.verificar');
        Route::match(['get', 'delete'],'/eliminar/{usuario}', [AdminController::class,'verificadoEliminar'])->name('verificados.eliminar');

        Route::get('/restaurar/{usuario}', [AdminController::class, 'verificadoRestaurar'])->name('verificados.restaurar');
    });


    // Usuarios
    Route::prefix('/usuarios')->group(function () {
        Route::get('/', [AdminController::class, 'listadoUsuarios'])->name('usuarios');

        Route::delete('/eliminar/{id}', [AuthController::class, 'bloquearUsuario'])->name('usuarios.eliminar');
        Route::get('/restaurar/{id}', [AuthController::class, 'restaurarUsuario'])->name('usuarios.restaurar');
        // TODO:
        /*Route::match(['get', 'delete'],'/eliminar/{usuario}', [AdminController::class,'usuarioEliminar'])->name('usuarios.eliminar');

        Route::get('/restaurar/{usuario}', [AdminController::class, 'usuarioRestaurar'])->name('usuarios.restaurar');*/
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

        Route::get('/detalle/{alerta}', [AdminController::class, 'detalleAlerta'])->name('alertas.detalle');

        Route::delete('/eliminar/{alerta}', [AdminController::class, 'eliminarAlerta'])->name('alertas.eliminar');
        Route::get('/restaurar/{alerta}', [AdminController::class, 'restaurarAlerta'])->name('alertas.restaurar');
    });

    Route::prefix('/contacto')->group(function () {
        Route::get('/', [AdminController::class, 'listadoContacto'])->name('contacto');
        Route::get('/{contacto}', [AdminController::class, 'detalleContacto'])->name('contacto.detalle');
    });
});
