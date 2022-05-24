<?php

namespace App\Http\Controllers;

use App\Models\Verificados;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VerificadosController extends Controller
{
    public function infoUsuario(int $usuario)
    {
        $data = Verificados::select('razon_social','email','telefono','imagen','status')->where('id_verificado', $usuario)->get();

        return response()->json([
           'success' => true,
           'data' => $data
        ]);
    }

    public function login(Request $request) : JsonResponse
    {

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

    public function register(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(),Verificados::$reglas,Verificados::$mensajesDeError);

        if ($validator->fails()) {
            return response()->json([
               'success' => false,
               'data' => $validator->messages()
            ]);
        }

        try {
            $cuit = $request->cuit;

            $crawler = $client->request('GET','https://www.dateas.com/es/consulta_cuit_cuil?cuit=' . $cuit);

            $RS = $crawler->filter("#mainContent > table > tbody > tr > td:nth-child(1) > a");

            $razon_social = $RS->html();

            try {
                $verificado = Verificados::create(array(
                        'cuit' => $cuit,
                        'razon_social' => $razon_social,
                        'email' => $request->email,
                        'password' => $request->password,
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    )
                );

                return $this->infoUsuario($verificado->id_verificado);
            }

            catch (\Exception $exception) {
                return response()->json([
                    'success' => false,
                    'data' => $exception
                ]);
            }
        }
        catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'El CUIT ingresado no pertenece a ninguna persona física, jurídica o entidad. Ingrese un CUIT válido'
            ]);
        }

    }
}
