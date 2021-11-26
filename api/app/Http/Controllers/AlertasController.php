<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AlertasController extends Controller
{
    /**
     * Returorna todas las alertas
     */
    public function all(){
        $alertas = Alerta::all();

        $data = [];
        foreach($alertas as $alerta){
            if($alerta->sexo){
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
                    'fecha' => $alerta->fecha,
                    'hora' => $alerta->hora,
                ];
            }else{
                $data[] = [
                    'id_alerta' => $alerta->id_alerta,
                    'id_usuario' => $alerta->id_usuario,
                    'id_tipoalerta' => $alerta->id_tipoalerta,
                    'especie' => $alerta->especie->especie,
                    'raza' => $alerta->raza->raza,
                    'sexo' => null,
                    'descripcion' => $alerta->descripcion,
                    'nombre' => $alerta->nombre,
                    'latitud' => $alerta->latitud,
                    'longitud' => $alerta->longitud,
                    'imagenes' => $alerta->imagenes,
                    'fecha' => $alerta->fecha,
                    'hora' => $alerta->hora,
                ];
            }
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function ver($alerta){
        $alerta = Alerta::findOrFail($alerta);
        $alerta->telefono = $alerta->usuario->telefono;

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
        $request->validate(Alerta::$reglas, Alerta::$mensajesDeError);

        if ($request->input('imagenes')) {
            $extension = explode('/', explode(';', $request->imagenes)[0])[1];
            $nombreImg = date('Ymd-his') . '.' . $extension;

            Image::make($request->input('imagenes'))->save(public_path('imgs/mascotas/') . $nombreImg);
        }else{
            $nombreImg = 'default.jpg';
        }

        $data = [
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
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

    public function editar(Request $request){
        $request->validate(Alerta::$reglas, Alerta::$mensajesDeError);

        $alerta = Alerta::find($request->input('id_alerta'));


        if ($request->input('imagenes')) {
            $extension = explode('/', explode(';', $request->imagenes)[0])[1];
            $nombreImg = date('Ymd-his') . '.' . $extension;

            Image::make($request->input('imagenes'))->save(public_path('imgs/mascotas/') . $nombreImg);

            $alerta->nombre = $request->input('nombre');
            $alerta->descripcion = $request->input('descripcion');
            $alerta->fecha = $request->input('fecha');
            $alerta->hora = $request->input('hora');
            $alerta->imagenes = $nombreImg;
            $alerta->latitud = $request->input('latitud');
            $alerta->longitud = $request->input('longitud');
            $alerta->id_usuario = $request->input('id_usuario');
            $alerta->id_especie = $request->input('id_especie');
            $alerta->id_raza = $request->input('id_raza');
            $alerta->id_sexo = $request->input('id_sexo');
            $alerta->id_tipoalerta = $request->input('id_tipoalerta');

        }else{

            $alerta->nombre = $request->input('nombre');
            $alerta->descripcion = $request->input('descripcion');
            $alerta->fecha = $request->input('fecha');
            $alerta->hora = $request->input('hora');
            $alerta->latitud = $request->input('latitud');
            $alerta->longitud = $request->input('longitud');
            $alerta->id_usuario = $request->input('id_usuario');
            $alerta->id_especie = $request->input('id_especie');
            $alerta->id_raza = $request->input('id_raza');
            $alerta->id_sexo = $request->input('id_sexo');
            $alerta->id_tipoalerta = $request->input('id_tipoalerta');

        }

        $alerta->save();

        return response()->json([
           'success' => true,
           'data' => $alerta,
        ]);
    }

    public function borrar($alerta){
        Alerta::findOrFail($alerta)->delete();

        return response()->json([
           'success' => true,
        ]);
    }
}
