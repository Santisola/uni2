<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    public function contacto(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),Contacto::$reglas,Contacto::$mensajesDeError);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
                'mensaje' => $validator->messages()
            ]);
        }

        try {
            Contacto::create(array(
                'asunto' => $request->asunto,
                'mensaje' => $request->mensaje,
                'id_verificado' => $request->id_verificado,
                "created_at" => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            ));

            return response()->json([
               'success' => true,
               'mensaje' => 'Su mensaje ha sido enviado, le responderemos a la brevedad'
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'mensaje' => $exception->getMessage()
            ]);
        }
    }
}
