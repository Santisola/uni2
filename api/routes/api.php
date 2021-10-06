<?php

use App\Http\Controllers\AlertasController;
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

Route::delete('/alertas/{id}', [AlertasController::class, 'borrar']);

Route::get('/usuario/{id}/alertas', [AlertasController::class, 'deUsuario']);