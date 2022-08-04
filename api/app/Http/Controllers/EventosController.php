<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use App\Models\Verificados;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventosController extends Controller
{
    /**
     * Trae todos los eventos publicados (front de la app)
     * @return JsonResponse
     */
    public function eventosPublicados() : JsonResponse
    {
        try {
            $eventos = Eventos::withoutTrashed()
                ->where('publicado',true);

            $data = [];
            foreach($eventos as $evento){
                $data[] = $evento;
            }

            return response()->json([
                'success' => true,
                'eventos' => $data
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

            $evento = Eventos::withoutTrashed()
                ->where('id_evento', $id)
                ->where('publicado', true)
                ->first();

            $telefono = Verificados::findOrFail($evento->id_verificado)
                ->select('telefono')
                ->get()
                ->first();

            $evento['telefono'] = $telefono['telefono'];

            return response()->json([
                'success' => true,
                'evento' => $evento,
                'contacto' => $telefono
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

            $eventos = Eventos::withTrashed()
                ->orderBy('updated_at','desc')
                ->where('id_verificado',$usuario)
                ->get();

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
    public function eventoVerificado( int $id_evento) : JsonResponse
    {
        try {
            $evento = Eventos::findOrFail($id_evento);

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

            if (!is_string($request->imagen)) {
                $file_name = Str::random(35) . '_' . trim($request->imagen->getClientOriginalName());
                $request->imagen->move(public_path('/imgs/eventos'),$file_name);
                $path = "public/imgs/eventos/$file_name";
            } else {
                $path = $request->imagen;
            }

            $publicado = 0;

            if (filter_var($request->publicado, FILTER_VALIDATE_BOOL) === true) {
                $publicado = 1;
            }

            $evento->nombre = $request->nombre;
            $evento->descripcion = $request->descripcion;
            $evento->direccion = $request->direccion;
            $evento->latitud = $request->latitud;
            $evento->longitud = $request->longitud;
            $evento->desde = Carbon::parse($request->desde)->format('Y-m-d\TH:i');
            $evento->hasta = Carbon::parse($request->hasta)->format('Y-m-d\TH:i');
            $evento->imagen = $path;
            $evento->publicado = $publicado;
            $evento->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');

            $evento->save();

            return response()->json([
               'success' => true,
               'evento' => $evento
            ]);

        } catch (\Exception $exception) {
            return response()->json([
               'success' => false,
               'mensaje' => 'Hubo un error al intentar editar su evento',
                'Error' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Creación de un nuevo evento
     * @param Request $request
     * @return JsonResponse
     */
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

            $file_name = Str::random(35) . '_' . trim($request->imagen->getClientOriginalName());
            $request->imagen->move(public_path('/imgs/eventos'),$file_name);
            $path = "public/imgs/eventos/$file_name";

            $publicado = 0;

            if (filter_var($request->publicado, FILTER_VALIDATE_BOOL) === true) {
                $publicado = 1;
            }

            Eventos::create(array(
                "nombre" => $request->nombre,
                "descripcion" => $request->descripcion,
                "direccion" => $request->direccion,
                "latitud" => $request->latitud,
                "longitud" => $request->longitud,
                "desde" => Carbon::parse($request->desde)->format('Y-m-d\TH:i'),
                "hasta" => Carbon::parse($request->hasta)->format('Y-m-d\TH:i'),
                "imagen" => $path,
                "publicado" => $publicado,
                'id_verificado' => $request->id_verificado,
                'created_at' => Carbon::now('UTC'),
                'updated_at' => Carbon::now('UTC')
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
