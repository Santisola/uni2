<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function comentarios(int $noticia): JsonResponse
    {
        try {
            $comentarios = Comentarios::where('id_noticia', $noticia)
                ->with('verificado')
                ->orderBy('created_at','asc')
                ->get();

            return response()->json([
               'success' => true,
               'comentarios' => $comentarios
            ]);

        } catch (\Exception $exception) {
            return response()->json([
               'success' => false,
               'mensaje' => $exception->getMessage()
            ]);
        }
    }

    public function crearComentario(int $usuario, int $noticia, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), Comentarios::$reglas, Comentarios::$mensajesDeError);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'mensaje' => $validator->messages(),
            ]);
        }

        try {

          Comentarios::create(array(
              "comentario" => $request->comentario,
              'id_verificado' => $usuario,
              'id_noticia' => $noticia,
              "created_at" => Carbon::now('UTC'),
              "updated_at" => Carbon::now('UTC'),
          ));

          return $this->comentarios($noticia);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'mensaje' => $exception->getMessage(),
                'exception' => 'el try falla'
            ]);
        }
    }
}
