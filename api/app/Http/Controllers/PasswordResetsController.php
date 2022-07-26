<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $token = '123456';

        $hayTokenDeUsuario = DB::table('password_resets')->where('email', $request->email)->get();

        if(count($hayTokenDeUsuario) > 0){
            DB::table('password_resets')->where('email', $request->email)->delete();
        }

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // TODO: MANDAR EL MAIL QUE TE MANDE PARA EL FORM DE LARAVEL

        return response()->json([
            'success' => true,
            'u' => $usuario
        ]);
    }

    public function validarToken(Request $request){
        $tokenData = DB::table('password_resets')->where('email', $request->email)->get();

        return $tokenData;
    }
}
