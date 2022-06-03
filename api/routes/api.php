<?php

use App\Http\Controllers\AlertasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\NoticiasController;
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
Route::get('/alertas/{id}', [AlertasController::class, 'ver']);

Route::post('/alertas', [AlertasController::class, 'nueva']);

Route::put('/alertas/{id}', [AlertasController::class, 'editar']);

Route::delete('/alertas/{id}', [AlertasController::class, 'borrar']);

Route::get('/razas', [AlertasController::class, 'razas']);

Route::get('/usuario/{id}/alertas', [AlertasController::class, 'deUsuario']);

Route::put('/usuario/{id}', [AuthController::class, 'editar']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::post('/registro', [AuthController::class, 'registrar']);

/**
 * CMS Usuarios verificados
 */
Route::post('/verificado/login', [VerificadosController::class,'login']);
Route::post('/verificado/register', [VerificadosController::class,'register']);

Route::put('/verificado/{usuario}/update', [VerificadosController::class,'update']);
Route::put('/verificado/{usuario}/complete', [VerificadosController::class,'completeData']);

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
Route::get('/eventos-cms/{usuario}/{id_evento}', [EventosController::class, 'eventoVerificado']);

Route::put('/eventos-cms/{id_evento}/editar', [EventosController::class , 'editar']);

Route::post('/nuevo-evento',[EventosController::class, 'nuevo']);
