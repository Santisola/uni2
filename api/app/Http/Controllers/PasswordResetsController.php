<?php

namespace App\Http\Controllers;

use App\Mail\OlvideMiContra;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetsController extends Controller
{
    public function updatePasswordForm(){
        return view('passwordReset.resetPasswordForm');
    }

    public function generarToken(Request $request){
        $request->validate([
            'email' => 'required|email'
        ],[
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email tiene que tener un formato válido (correo@dominio.extension)',
        ]);

        $usuario = User::where('email', $request->email)->get();

        if(count($usuario) == 0){
            return response()->json([
                'success' => false,
                'msj' => 'El email ingresado no coincide con nuestros registros.',
            ]);
        }

        $hayTokenDeUsuario = DB::table('password_resets')->where('email', $request->email)->get();

        if(count($hayTokenDeUsuario) > 0){
            DB::table('password_resets')->where('email', $request->email)->delete();
        }

        $token = (string)rand(0,9) . (string)rand(0,9) . (string)rand(0,9) . (string)rand(0,9) . (string)rand(0,9) . (string)rand(0,9);

        $mail = new OlvideMiContra($token);
        Mail::to($request->email)->send($mail);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'u' => $usuario
        ]);
    }

    public function validarToken(Request $request){
        $tokenData = DB::table('password_resets')->where('email', $request->email)->get()[0];

        $valido = false;
        if($tokenData->email == $request->email && $tokenData->token == $request->token){
            $valido = true;

            DB::table('password_resets')->where('email', $request->email)->delete();
        }

        return response()->json([
            'valido' => $valido
        ]);
    }

    public function reestablecerContra(Request $request){
        $request->validate([
            'contra' => 'required',
            'contra2' => 'required',
        ],[
            'contra.required' => 'El email es obligatorio',
            'contra2.required' => 'La confirmación es obligatoria',
        ]);

        try{
            $usuario = User::where('email', $request->email)->get()[0];

            $usuario->password = Hash::make($request->contra);

            $usuario->save();

            return response()->json([
                'success' => true,
                'data' => [
                    'id_usuario' => $usuario->id_usuario,
                    'email' => $usuario->email,
                    'nombre' => $usuario->nombre,
                    'telefono' => $usuario->telefono,
                ],
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
