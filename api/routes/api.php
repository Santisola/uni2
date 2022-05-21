<?php

use App\Http\Controllers\AlertasController;
use App\Http\Controllers\AuthController;
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

Route::get('/alertas', [AlertasController::class, 'all']);
Route::get('/alertas/{id}', [AlertasController::class, 'ver']);

Route::post('/alertas', [AlertasController::class, 'nueva']);

Route::put('/alertas/{id}', [AlertasController::class, 'editar']);

Route::delete('/alertas/{id}', [AlertasController::class, 'borrar']);

Route::get('/razas', [AlertasController::class, 'razas']);

Route::get('/usuario/{id}/alertas', [AlertasController::class, 'deUsuario']);

Route::get('/verificado/{id}/infoUsuario', [VerificadosController::class, 'infoUsuario']);

Route::put('/usuario/{id}', [AuthController::class, 'editar']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::post('/verificado/login', [VerificadosController::class,'login']);

Route::post('/registro', [AuthController::class, 'registrar']);
