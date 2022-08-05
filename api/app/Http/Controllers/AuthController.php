<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ],[
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email tiene que tener un formato válido (correo@dominio.extension)',
            'password.required' => 'La contraseña es obligatoria'
        ]);

        $usuario = User::withTrashed()->where('email', $request->email)->first();

        if(!$usuario || !Hash::check($request->password, $usuario->password)){
            return response()->json([
                'success' => false,
                'mensaje' => 'Los datos ingresados no coinciden con nuestros registros'
             ]);
        }

        if($usuario->deleted_at){
            return response()->json([
                'success' => false,
                'mensaje' => 'Tu usuario está bloqueado. Por favor comunicate con nosotros.'
            ]);
        }

        $token = $usuario->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'id_usuario' => $usuario->id_usuario,
                'email' => $usuario->email,
                'nombre' => $usuario->nombre,
                'imagen' => $usuario->imagen,
                'telefono' => $usuario->telefono,
            ],
            'token' => $token
        ]);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function editar(Request $request){
        $request->validate([
            'nombre'=>'required',
            'email'=>'required|email:rfc',
            'telefono'=>'required',
        ],[
            'nombre.required'=>'El nombre es obligatorio',
            'email.required'=>'El email es obligatorio',
            'email.email'=>'El email debe ser de un formato válido (nombre@dominio.extension)',
            'telefono.required'=>'El teléfono es obligatorio',
        ]);

        $user = User::findOrFail($request->id_usuario);

        if ($request->imagen) {
            $extension = explode('/', explode(';', $request->imagen)[0])[1];
            $nombreImg = date('Ymd-his') . '.' . $extension;

            $path = 'imgs/perfiles/' . $nombreImg;

            Image::make($request->imagen)->save(public_path('imgs/perfiles/') . $nombreImg);

            $user->imagen = $path;
        }

        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->telefono = $request->telefono;

        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
         ]);
    }

    public function registrar(Request $request){
        $request->validate(User::$reglas, User::$mensajesDeError);

        if ($request->imagen) {
            $extension = explode('/', explode(';', $request->imagen)[0])[1];
            $nombreImg = date('Ymd-his') . '.' . $extension;

            $path = 'imgs/perfiles/' . $nombreImg;

            Image::make($request->imagen)->save(public_path('imgs/perfiles/') . $nombreImg);
        }else{
            $path = null;
        }

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'imagen' => $path,
            'password' => Hash::make($request->password),
        ]);


        $usuario = User::where('email', $request->email)->first();

        if(!$usuario || !Hash::check($request->password, $usuario->password)){
            return response()->json([
                'success' => false,
                'mensaje' => 'Ocurrió un error al intentar iniciar la sesión',
             ]);
        }

        $token = $usuario->createToken('Dispositivo de ' . $request->email)->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'id_usuario' => $usuario->id_usuario,
                'email' => $usuario->email,
                'nombre' => $usuario->nombre,
                'imagen' => $usuario->imagen,
                'telefono' => $usuario->telefono,
            ],
            'token' => $token
        ]);
    }

    public function bloquearUsuario($id){
        try {
            User::findOrFail($id)->delete();

            return redirect()
                ->route('usuarios')
                ->with('message','Usuario bloqueado')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('usuarios')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function restaurarUsuario($id){
        try {
            $usuario = User::onlyTrashed()->findOrFail($id);
            $usuario->restore();

            return redirect()
                ->route('usuarios')
                ->with('message','Usuario desbloqueado')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('usuarios')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }
}
