<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventosController extends Controller
{
    /**
     * Trae todos los eventos publicados (front de la app)
     * @return JsonResponse
     */
    public function eventosPublicados() : JsonResponse
    {
        try {
            $eventos = Eventos::all()->where('publicado',true);

            return response()->json([
                'success' => true,
                'eventos' => $eventos
            ]);

        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'mensaje' => 'Ups ocurrió un problema al tratar de cargar los eventos'
            ]);
        }
    }

    /**
     * Muestra el detalle de ese evento publicado
     * @param int $id
     * @return JsonResponse
     */
    public function eventoPublicado(int $id) : JsonResponse
    {
        try {

            $evento = Eventos::all()
                ->where('id_evento', $id)
                ->where('publicado', true)
                ->first();

            return response()->json([
                'success' => true,
                'evento' => $evento
            ]);

        } catch (\Exception $exception) {

            return response()->json([
               'success' => false,
                'mensaje' => 'Ese evento no se encuentra registrado'
            ]);
        }
    }

    /**
     * Función que trae los eventos del usuario verificado (CMS)
     * @param int $usuario
     * @return JsonResponse
     */
    public function eventosVerificados(int $usuario) : JsonResponse
    {
        try {

            $eventos = Eventos::all()->where('id_verificado',$usuario);

            return response()->json([
                'success' => true,
                'eventos' => $eventos
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'mensaje' => 'No tiene eventos cargados'
            ]);
        }
    }

    /**
     * Trae el evento del usuario verificado
     * @param int $id_evento
     * @return JsonResponse
     */
    public function eventoVerificado( int $usuario, int $id_evento) : JsonResponse
    {
        try {
            $evento = Eventos::all()
                ->where('id_evento', $id_evento)
                ->where('id_verificado', $usuario)
                ->first();
            return response()->json([
               'success' => true,
               'evento' => $evento
            ]);

        } catch (\Exception $exception) {
            return response()->json([
               'success' => false,
               'mensaje' => 'El evento que intenta buscar no existe'
            ]);
        }
    }

    /**
     * @param Request $request
     * @param int $evento
     * @return JsonResponse
     */
    public function editar(Request $request, int $evento): JsonResponse
    {
        $validator = Validator::make($request->all(), Eventos::$reglas, Eventos::$mensajesDeError);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'mensaje' => $validator->messages()
            ]);
        }

        try {
            $evento = Eventos::all()
                ->where('id_evento', $evento)
                ->first();

            $evento->nombre = $request->nombre;
            $evento->descripcion = $request->descripcion;
            $evento->latitud = $request->latitud;
            $evento->longitud = $request->longitud;
            $evento->desde = $request->desde;
            $evento->hasta = $request->hasta;
            $evento->imagen = $request->imagen;
            $evento->publicado = $request->publicado;

            $evento->save();

            return response()->json([
               'success' => true,
               'evento' => $evento
            ]);

        } catch (\Exception $exception) {
            return response()->json([
               'success' => false,
               'mensaje' => 'Hubo un error al intentar editar su evento'
            ]);
        }
    }

    public function nuevo(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), Eventos::$reglas, Eventos::$mensajesDeError);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'mensaje' => $validator->messages()
            ]);
        }

        try {
            $evento = Eventos::create(array(
                'nombre' => $request->nombre,
                "descripcion" => $request->descripcion,
                "latitud" => $request->latitud,
                "longitud" => $request->longitud,
                "desde" => $request->desde,
                "hasta" => $request->hasta,
                "imagen" => $request->imagen,
                "publicado" => $request->publicado,
                'id_verificado' => $request->id_verificado,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ));

            return $this->eventosVerificados($request->id_verificado);

        } catch (\Exception $exception) {
            return response()->json([
               'success' => false,
               'mensaje' => 'Hubo un error al momento de crear su evento',
                'error' => $exception->getMessage()
            ]);
        }
    }
}
