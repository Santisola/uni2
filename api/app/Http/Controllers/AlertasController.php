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

        $data = [];
        foreach($alertas as $alerta){
            $data[] = [
                'id_alerta' => $alerta->id_alerta,
                'id_usuario' => $alerta->id_usuario,
                'id_tipoalerta' => $alerta->id_tipoalerta,
                'especie' => $alerta->especie->especie,
                'raza' => $alerta->raza->raza,
                'sexo' => $alerta->sexo->sexo,
                'descripcion' => $alerta->descripcion,
                'nombre' => $alerta->nombre,
                'latitud' => $alerta->latitud,
                'longitud' => $alerta->longitud,
                'imagenes' => $alerta->imagenes,
                'fecha' => $alerta->created_at,
            ];
        }

        return response()->json([
            'data' => $data
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
        //$alertaNueva = Alerta::create($request->input());

        if ($request->hasFile('imagenes')) {
            $extension = $request->imagenes->extension();
            $nombreImg = date('Ymd-his') . $extension;

            $path = $request->imagenes->store('images');
        }else{
            $nombreImg = date('Ymd-his') . '.jpg';
        }

        $data = [
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'imagenes' => $nombreImg,
            'latitud' => $request->input('latitud'),
            'longitud' => $request->input('longitud'),
            'id_usuario' => $request->input('id_usuario'),
            'id_especie' => $request->input('id_especie'),
            'id_raza' => $request->input('id_raza'),
            'id_sexo' => $request->input('id_sexo'),
            'id_tipoalerta' => $request->input('id_tipoalerta'),
        ];

        $alertaNueva = Alerta::create($data);

        return response()->json([
           'success' => true,
           'data' => $alertaNueva,
        ]);
    }

    public function borrar($alerta){
        Alerta::findOrFail($alerta)->delete();

        return response()->json([
           'success' => true,
        ]);
    }
}
