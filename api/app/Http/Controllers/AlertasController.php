<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertasController extends Controller
{
    /**
     * Returorna todas las alertas
     */
    public function all(){
        $alertas = Alerta::all();

        return response()->json([
            'data' => $alertas
        ]);
    }

    public function ver($alerta){
        $alerta = Alerta::findOrFail($alerta);

        return response()->json([
            'data' => $alerta
        ]);
    }

    public function deUsuario($usuario){
        $alertas = Alerta::where('id_usuario', $usuario)->get();

        return response()->json([
            'data' => $alertas
        ]);
    }

    public function nueva(Request $request){
        //TODO: Validar
        $alertaNueva = Alerta::create($request->input());

        return response()->json([
           'success' => true,
           'data' => $alertaNueva,
        ]);
    }

    public function borrar($alerta){
        Alerta::destroy($alerta);

        return response()->json([
           'success' => true,
        ]);
    }
}
