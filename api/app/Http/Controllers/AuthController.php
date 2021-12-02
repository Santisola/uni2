<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ],[
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email tiene que tener un formato válido (correo@dominio.extension)',
            'password.required' => 'La contraseña es obligatoria'
        ]);

        $usuario = User::where('email', $request->email)->first();

        if(!$usuario || !Hash::check($request->password, $usuario->password)){
            return response()->json([
                'success' => false,
                'mensaje' => 'Los datos ingresados no coinciden con nuestros registros'
             ]);
        }

        $token = $usuario->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'id_usuario' => $usuario->id_usuario,
                'email' => $usuario->email,
                'nombre' => $usuario->nombre,
                'telefono' => $usuario->telefono,
            ],
            'token' => $token
        ]);
    }

    public function logout() {
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

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
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
                'telefono' => $usuario->telefono,
            ],
            'token' => $token
        ]);
    }
}
