<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\AlertaImg;
use App\Models\Raza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class AlertasController extends Controller
{
    /**
     * Returorna todas las alertas
     */
    public function all(){
        $alertas = Alerta::withoutTrashed()->where('finalizada', 0)->get();

        $data = [];
        foreach($alertas as $alerta){
            if($alerta->usuario){

                $imgs = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);
            $formatImgs = [];
            foreach($imgs as $img){
                $formatImgs[] = $img;
            }
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
                    'imagenes' => $formatImgs,
                    'fecha' => $alerta->fecha,
                    'hora' => $alerta->hora,
                    'finalizada' => $alerta->finalizada,
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
                    'imagenes' => $formatImgs,
                    'fecha' => $alerta->fecha,
                    'hora' => $alerta->hora,
                    'finalizada' => $alerta->finalizada,
                ];
            }

            }
        }

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Returorna todas las razas
     */
    public function razas(){
        $razas = Raza::all();

        return response()->json([
            'data' => $razas
        ]);
    }

    public function ver($alerta){
        $alerta = Alerta::findOrFail($alerta);
        $alerta->telefono = $alerta->usuario->telefono;
        $alerta->raza = $alerta->raza->raza;

        $imgs = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);
        $formatImgs = [];
        foreach($imgs as $img){
            $formatImgs[] = $img;
        }

        $alerta->imagenes = $formatImgs;

        return response()->json([
            'data' => $alerta
        ]);
    }

    public function deUsuario($usuario){
        $alertas = Alerta::withoutTrashed()->where('id_usuario', $usuario)->get();

        foreach($alertas as $alerta){
            $imgs = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);
            $formatImgs = [];
            foreach($imgs as $img){
                $formatImgs[] = $img;
            }

            $alerta->imagenes = $formatImgs;
        }

        return response()->json([
            'data' => $alertas
        ]);
    }

    public function reencontradas(){
        $alertas = Alerta::withoutTrashed()->where('finalizada', 1)->get();

        foreach($alertas as $alerta){
            $alerta->telefono = $alerta->usuario->telefono;
            $alerta->raza = $alerta->raza->raza;

            $alerta->especie = $alerta->especie->especie;

            if($alerta->sexo){
                $alerta->sexo = $alerta->sexo->sexo;
            }

            $imgs = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);
            $formatImgs = [];
            foreach($imgs as $img){
                $formatImgs[] = $img;
            }

            $alerta->imagenes = $formatImgs;
        }

        return response()->json([
            'data' => $alertas
        ]);
    }

    public function nueva(Request $request){
        $request->validate(Alerta::$reglas, Alerta::$mensajesDeError);

        $imgsParaSubir = [];
        if ($request->input('imagenes')) {
            $cont = 0;
            foreach($request->input('imagenes') as $img){
                $extension = explode('/', explode(';', $img)[0])[1];
                $nombreImg = date('Ymd-his'). '_' . $cont . '.' . $extension;

                Image::make($img)->save(public_path('imgs/mascotas/') . $nombreImg);
                $imgsParaSubir[] = $nombreImg;
                $cont++;
            }
        }else{
            $nombreImg = 'default.jpg';
            $imgsParaSubir[] = $nombreImg;
        }

        $data = [
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha' => $request->input('fecha'),
            'hora' => $request->input('hora'),
            'imagenes' => 'default.jpg',
            'latitud' => $request->input('latitud'),
            'longitud' => $request->input('longitud'),
            'id_usuario' => $request->input('id_usuario'),
            'id_especie' => $request->input('id_especie'),
            'id_raza' => $request->input('id_raza'),
            'id_sexo' => $request->input('id_sexo'),
            'id_tipoalerta' => $request->input('id_tipoalerta'),
            'finalizada' => $request->input('finalizada'),
        ];

        $alertaNueva = Alerta::create($data);

        $imgsData = [];
        foreach($imgsParaSubir as $img){
            $imgsData[] = [
                'imagen' => $img,
                'id_alerta' => $alertaNueva->id_alerta,
            ];
        }

        DB::table('alerta_imgs')->insert($imgsData);

        return response()->json([
           'success' => true,
           'data' => $alertaNueva,
        ]);
    }

    public function editar(Request $request){
        $request->validate(Alerta::$reglas, Alerta::$mensajesDeError);

        $alerta = Alerta::find($request->input('id_alerta'));


        if ($request->input('imagenes')) {
            $imgsActuales = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);

            foreach($imgsActuales as $img){
                $img->delete();
            }

            $imgsParaSubir = [];
            $cont = 0;
            foreach($request->input('imagenes') as $img){
                $extension = explode('/', explode(';', $img)[0])[1];
                $nombreImg = date('Ymd-his'). '_' . $cont . '.' . $extension;

                Image::make($img)->save(public_path('imgs/mascotas/') . $nombreImg);
                $imgsParaSubir[] = $nombreImg;
                $cont++;
            }

            $imgsData = [];
            foreach($imgsParaSubir as $img){
                $imgsData[] = [
                    'imagen' => $img,
                    'id_alerta' => $alerta->id_alerta,
                ];
            }

            DB::table('alerta_imgs')->insert($imgsData);
        }

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

    public function alternarEstado($alerta){
        $alerta = Alerta::findOrFail($alerta);

        $alerta->finalizada = !$alerta->finalizada;

        $alerta->save();

        return response()->json([
           'success' => true,
           'data' => $alerta,
        ]);
    }
}
