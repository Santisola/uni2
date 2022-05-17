<?php

namespace App\Http\Controllers;

use App\Models\Verificados;
use Illuminate\Http\JsonResponse;

class VerificadosController extends Controller
{
    public function infoUsuario(int $usuario): JsonResponse
    {
        $datos = Verificados::select('nombre','apellido','email','telefono','imagen')->where('id_verificado', $usuario)->get();

        return response()->json([
            'data' => $datos
        ]);
    }
}
