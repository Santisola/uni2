<?php

use App\Http\Controllers\AlertasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\PasswordResetsController;
use App\Http\Controllers\VerificadosController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Main App
 */

Route::get('/alertas', [AlertasController::class, 'all']);
Route::get('/alertas/reencontradas', [AlertasController::class, 'reencontradas']);
Route::get('/alertas/{id}', [AlertasController::class, 'ver']);

Route::post('/alertas', [AlertasController::class, 'nueva']);

Route::put('/alertas/{id}', [AlertasController::class, 'editar']);

Route::put('/alertas/{id}/alternarEstado', [AlertasController::class, 'alternarEstado']);

Route::delete('/alertas/{id}', [AlertasController::class, 'borrar']);

Route::get('/razas', [AlertasController::class, 'razas']);

Route::get('/usuario/{id}/alertas', [AlertasController::class, 'deUsuario']);

Route::put('/usuario/{id}', [AuthController::class, 'editar']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::post('/registro', [AuthController::class, 'registrar']);

Route::post('/generar-token', [PasswordResetsController::class, 'generarToken']);
Route::post('/validar-token', [PasswordResetsController::class, 'validarToken']);
Route::put('/reestablecer-contra', [PasswordResetsController::class, 'reestablecerContra']);

/**
 * CMS Usuarios verificados
 */
Route::post('/verificado/login', [VerificadosController::class,'login']);
Route::post('/verificado/register', [VerificadosController::class,'register']);
Route::post('/verificado/olvidePassword', [VerificadosController::class, 'olvideMiPassword']);

Route::put('/verificado/{usuario}/complete', [VerificadosController::class,'completeData']);
Route::put('/verificado/{usuario}/EditarNombre', [VerificadosController::class,'editarNombre']);
Route::put('/verificado/{usuario}/EditarEmail', [VerificadosController::class,'editarEmail']);
Route::put('/verificado/{usuario}/EditarTelefono', [VerificadosController::class,'editarTelefono']);
Route::put('/verificado/{usuario}/EditarImagen', [VerificadosController::class,'editarImagen']);
Route::put('/verificado/{usuario}/EditarPassword', [VerificadosController::class,'editarPassword']);

/**
 * CMS Noticias
 */
Route::get('/noticias', [NoticiasController::class, 'all']);
Route::get('/noticias/{noticia}', [NoticiasController::class, 'noticia']);

/**
 * APP & CMS Eventos
 */

// Aplicación Uni2
Route::get('/eventos',[EventosController::class,'eventosPublicados']);
Route::get('/evento/{id}',[EventosController::class,'eventoPublicado']);

// CMS verificados
Route::get('/eventos-cms/{usuario}', [EventosController::class, 'eventosVerificados']);
Route::get('/evento-cms/{id_evento}', [EventosController::class, 'eventoVerificado']);

Route::put('/evento-cms/{id_evento}/editar', [EventosController::class , 'editar']);

Route::post('/nuevo-evento',[EventosController::class, 'nuevo']);

/**
 * CMS Comentarios
 */
Route::get('/comentarios/{noticia}', [ComentarioController::class, 'comentarios']);
Route::post('/comentarios/{usuario}/{noticia}', [ComentarioController::class, 'crearComentario']);

/**
 * CMS contacto
 */
Route::post('/contacto',[ContactoController::class, 'contacto']);
