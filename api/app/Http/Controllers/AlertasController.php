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

        return $alertas->toJson();
    }

    public function ver($alerta){
        $alerta = Alerta::find($alerta);

        return $alerta->toJson();
    }
}
