<?php

namespace App\Http\Controllers;

use App\Models\Verificados;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function register(Request $request, Client $client) : JsonResponse
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

    /**
     * Edita los datos del usuario
     * @param Request $request
     * @param int $usuario
     * @return JsonResponse
     */
    public function update(Request $request,int $usuario) : JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'imagen' => 'image|required|max:10000',
            'telefono' => 'required|unique:usuarios_verificados,telefono',
            'password' => 'required'
        ],[
            'email.required'=>'El email es obligatorio',
            'email.email'=>'El email debe ser de un formato válido (nombre@dominio.extension)',
            'email.unique'=>'El email que intenta ingresar ya existe en nuestra base de datos',
            'password.required'=>'La contraseña es obligatoria',
            'imagen.image' => 'El formato de la imagen no es valido. Intente en un formato .jpeg, .jpg o .png',
            'imagen.required' => 'La imagen en esta sección es obligatoria',
            'imagen.max' => 'La imagen es muy pesada, intente una menor tamaño',
            'telefono.required' => 'El teléfono en esta instancia es obligatorio',
            'telefono.unique' => 'Ese número de teléfono ya se encuentra registrado'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);
            $file_name = Str::random(35) . '_' . $request->imagen->getClientOriginalName();
            $request->imagen->move(public_path('/imgs/perfiles'),$file_name);
            $path = "public/images/perfiles/$file_name";

            $user->imagen = $path;
            $user->telefono = $request->telefono;
            $user->email = $request->email;
            $request->password === '' ?? $user->password = $request->password;

            $user->save();

            return response()->json([
               'success'=> true,
               'data' => $user
            ]);

        } catch (\Exception $exception) {
            return response()->json([
               'success' => false,
               'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }

    public function completeData(Request $request, int $usuario)
    {
        $validator = Validator::make($request->all(),[
            'imagen' => 'image|required|max:10000',
            'telefono' => 'required|unique:usuarios_verificados,telefono',
        ],[
            'imagen.image' => 'El formato de la imagen no es valido. Intente en un formato .jpeg, .jpg o .png',
            'imagen.required' => 'La imagen en esta sección es obligatoria',
            'imagen.max' => 'La imagen es muy pesada, intente una menor tamaño',
            'telefono.required' => 'El teléfono en esta instancia es obligatorio',
            'telefono.unique' => 'Ese número de teléfono ya se encuentra registrado'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);
            $file_name = Str::random(35) . '_' . $request->imagen->getClientOriginalName();
            $request->imagen->move(public_path('/imgs/perfiles'),$file_name);
            $path = "public/images/perfiles/$file_name";

            $user->imagen = $path;
            $user->telefono = $request->telefono;

            $user->save();

            return response()->json([
                'success'=> true,
                'data' => $user
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }
}
