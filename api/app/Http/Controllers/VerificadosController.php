<?php

namespace App\Http\Controllers;

use App\Models\Verificados;
use Goutte\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class VerificadosController extends Controller
{
    public function infoUsuario(int $usuario)
    {
        $data = Verificados::select('razon_social','email','telefono','imagen','status')->where('id_verificado', $usuario)->get();

        return response()->json([
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
        // URL https://www.dateas.com/es/consulta_cuit_cuil?cuit=$cuit
        try {
            $crawler = $client->request('GET','https://www.dateas.com/es/consulta_cuit_cuil?cuit=20389958043');
            $RS = $crawler->filter("#mainContent > table > tbody > tr > td:nth-child(1) > a");

            return response()->json([
                'success' => true,
                'data' => $RS->html()
            ]);
        }
        catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'No existe ese CUIT'
            ]);
        }
    }
}
