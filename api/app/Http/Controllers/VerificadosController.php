<?php

namespace App\Http\Controllers;

use App\Models\Verificados;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VerificadosController extends Controller
{
    public function infoUsuario(int $usuario)
    {
        $data =  Verificados::select('nombre','apellido','email','telefono','imagen','status')->where('id_verificado', $usuario)->get();

        return response()->json([
           'data' => $data
        ]);
    }

    public function login(Request $request) : JsonResponse
    {
/*        return response()->json([
            'data' => $request->cuit
        ]);*/

        $usuario = Verificados::where('email', $request->email)
            ->where('cuit',$request->cuit)
            ->first();

        if(!$usuario || !Hash::check($request->password, $usuario->password)){
            return response()->json([
                'success' => false,
                'mensaje' => 'Los datos ingresados no coinciden con nuestros registros'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $this->infoUsuario($usuario->id_verificado)
        ]);
    }
}
