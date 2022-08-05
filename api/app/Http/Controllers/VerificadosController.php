<?php

namespace App\Http\Controllers;

use App\Mail\MailVerificados;
use App\Models\Verificados;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VerificadosController extends Controller
{
    public function infoUsuario(int $usuario): JsonResponse
    {
        $data = Verificados::select('razon_social','nombre','email','telefono','imagen','status','deleted_at')
            ->withTrashed()
            ->where('id_verificado', $usuario)
            ->get();

        return response()->json([
           'success' => true,
           'data' => $data,
            'id' => $usuario
        ]);
    }

    public function login(Request $request) : JsonResponse
    {

        $usuario = Verificados::where('email', $request->email)->withTrashed()
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
                        'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
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

    public function completeData(Request $request, int $usuario) : JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'imagen' => 'image|required|max:10000',
            'telefono' => 'required|unique:usuarios_verificados,telefono',
            'nombre' => 'required|min:3',
        ],[
            'imagen.image' => 'El formato de la imagen no es valido. Intente en un formato .jpeg, .jpg o .png',
            'imagen.required' => 'La imagen en esta sección es obligatoria',
            'imagen.max' => 'La imagen es muy pesada, intente una menor tamaño',
            'telefono.required' => 'El teléfono en esta instancia es obligatorio',
            'telefono.unique' => 'Ese número de teléfono ya se encuentra registrado',
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);
            $file_name = md5(time()) . '_' . str_replace(' ','-',$request->imagen->getClientOriginalName());
            $request->imagen->move(public_path('/imgs/perfiles'),$file_name);
            $path = "public/imgs/perfiles/$file_name";

            $user->imagen = $path;
            $user->telefono = $request->telefono;
            $user->nombre = $request->nombre;
            $user->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');

            $user->save();

            return response()->json([
                $this->infoUsuario($user->id_verificado)
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }

    /**
     * Edita el nombre del usuario
     * @param Request $request
     * @param int $usuario
     * @return JsonResponse
     */
    public function editarNombre(Request $request, int $usuario): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|min:3',
        ],[
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);
            $user->nombre = $request->nombre;
            $user->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');
            $user->save();

            return response()->json([
                $this->infoUsuario($user->id_verificado)
            ]);


        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }

    /**
     * Edita el email
     * @param Request $request
     * @param int $usuario
     * @return JsonResponse
     */
    public function editarEmail(Request $request, int $usuario): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email:rfc|unique:usuarios_verificados,email',
        ],[
            'email.required'=>'El email es obligatorio',
            'email.email'=>'El email debe ser de un formato válido (nombre@dominio.extension)',
            'email.unique'=>'El email que intenta ingresar ya existe en nuestra base de datos',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);
            $user->email = $request->email;
            $user->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');
            $user->save();

            return response()->json([
                $this->infoUsuario($user->id_verificado)
            ]);


        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }

    /**
     * Edita el teléfono
     * @param Request $request
     * @param int $usuario
     * @return JsonResponse
     */
    public function editarTelefono(Request $request, int $usuario): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'telefono'=>'required|numeric|unique:usuarios_verificados,telefono',
        ],[
            'telefono.required'=>'El teléfono no puede estar vacío',
            'telefono.numeric'=>'El teléfono debe ser un número',
            'email.unique'=>'El teléfono que intenta ingresar ya existe en nuestra base de datos. Ingrese otro',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);
            $user->telefono = $request->telefono;
            $user->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');
            $user->save();

            return response()->json([
                $this->infoUsuario($user->id_verificado)
            ]);


        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }

    /**
     * Editar la imagen
     * @param Request $request
     * @param int $usuario
     * @return JsonResponse
     */
    public function editarImagen(Request $request, int $usuario): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'imagen' => 'image|required|max:10000',
        ],[
            'imagen.image' => 'El formato de la imagen no es valido. Intente en un formato .jpeg, .jpg o .png',
            'imagen.required' => 'La imagen en esta sección es obligatoria',
            'imagen.max' => 'La imagen es muy pesada, intente una menor tamaño',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);
            $file_name = md5(time()) . '_' . str_replace(' ','-',$request->imagen->getClientOriginalName());
            $request->imagen->move(public_path('/imgs/perfiles'),$file_name);
            $path = "public/imgs/perfiles/$file_name";

            $user->imagen = $path;
            $user->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');
            $user->save();

            return response()->json([
                $this->infoUsuario($user->id_verificado)
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }

    /**
     * Edita la contraseña
     * @param Request $request
     * @param int $usuario
     * @return JsonResponse
     */
    public function editarPassword(Request $request, int $usuario): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required',
        ],[
            'editarPassword.required' => 'La contraseña no puede estar vacía',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $user = Verificados::findOrFail($usuario);

            $user->password = $request->password;
            $user->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');
            $user->save();

            return response()->json([
                $this->infoUsuario($user->id_verificado)
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => 'Ocurrió un error al momento de modificar sus datos' . $exception
            ]);
        }
    }

    public function olvideMiPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'cuit' => 'required|numeric',
            'email' => 'required|email',
        ],[
            'cuit.required' => 'El cuit no puede estar vacío',
            'cuit.numeric' => 'El cuit deben ser solo números',
            'email.required' => 'El email no puede estar vacío',
            'email.email' => 'El email que ingresó no es válido',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validator->messages()
            ]);
        }

        try {
            $verificado = Verificados::where('email','=', $request->email)
                ->where('cuit','=', $request->cuit)
                ->withTrashed()
                ->first();

            if ($verificado === null) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Datos no válidos'
                ]);
            }

            $nuevaPass = Str::random();
            $verificado->password = $nuevaPass;
            $verificado->save();

            $mail = new MailVerificados($nuevaPass);
            Mail::to($verificado->email)->send($mail);

            return response()->json([
                'success' => true,
                'mensaje' => 'Le enviamos a su correo una contraseña provisoria'
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception->getMessage()
            ]);
        }
    }
}
