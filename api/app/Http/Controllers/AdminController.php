<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use App\Models\Verificados;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function listadoUsuarios()
    {
        $usuarios = Verificados::orderBy('updated_at','desc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function listadoNoticias()
    {
        $noticias = Noticias::orderBy('created_at','desc')->get();
        return view('noticias.index', compact('noticias'));
    }

    public function noticiaForm()
    {
        return view('noticias.crearForm');
    }

    public function crear(Request $request)
    {
        $request->validate(Noticias::$reglas, Noticias::$mensajesDeError);

        try {

            $file_name = md5(time()) . '_' . str_replace(' ','-',$request->imagen->getClientOriginalName());
            $request->imagen->move(public_path('/imgs/noticias'),$file_name);


            Noticias::create(array(
                "titulo" => $request->titulo,
                "contenido" => $request->contenido,
                "imagen" => $file_name,
                "slug" => $request->slug,
                "publicado" => $request->publicado,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ));

            return redirect()
                ->route('noticias')
                ->with('message','Noticia agregada')
                ->with('message_type','success');

        } catch (\Exception $exception) {
            return redirect()
                ->route('noticias.crearForm')
                ->with('message', $exception->getMessage())
                ->with('message_type','danger');
        }
    }

    public function detalle(int $id_noticia)
    {
        $noticia = $this->getNoticia($id_noticia);
        return view('noticias.detalle', compact('noticia'));
    }

    public function editarForm(int $id_noticia)
    {
        $noticia = $this->getNoticia($id_noticia);
        return view('noticias.editarForm', compact('noticia'));
    }

    public function editar(Request $request, int $id_noticia)
    {
        $request->validate(Noticias::$reglasEdit, Noticias::$mensajesDeError);

        try {
            if ($request->hasFile('imagen')) {
                $file_name = md5(time()) . '_' . str_replace(' ','-',$request->imagen->getClientOriginalName());
                $request->imagen->move(public_path('/imgs/noticias'),$file_name);
                $request->imagen = $file_name;
            }

            Noticias::where('id_noticia', '=', $id_noticia)
                ->update([
                    'titulo' => $request->titulo,
                    'contenido' => $request->contenido,
                    'imagen' => $request->imagen,
                    'slug' => $request->slug,
                    'publicado' => $request->publicado,
                    'updated_at' => Carbon::now(),
                ]);

            return redirect()
                ->route('noticias')
                ->with('message','Noticia Editada')
                ->with('message_type','success');

        } catch (\Exception $exception) {
            return redirect()
                ->route('noticias.crearForm')
                ->with('message', $exception->getMessage())
                ->with('message_type','danger');
        }
    }

    public function eliminar(int $id_eliminar)
    {
        try {
            Noticias::findOrFail($id_eliminar)->delete();

            return redirect()
                ->route('noticias')
                ->with('message','Noticia Eliminada')
                ->with('message_type','success');
        } catch (\Exception $exception) {
            return redirect()
                ->route('noticias.crearForm')
                ->with('message', 'No se pudo eliminar la noticia')
                ->with('message_type','danger');
        }
    }

    public function login(Request $request)
    {
        $credenciales = $request->only(['email', 'password']);
        if (!Auth::attempt($credenciales)) {
            return redirect()
                ->route('auth.loginForm')
                ->withInput()
                ->with('message', 'Email o Contraseña inválido')
                ->with('message_type','danger');
        }

        return redirect()
            ->route('home')
            ->with('message', '¡Bienvenido ' . Auth::user()->nombre . '!')
            ->with('message_type','success');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()
            ->route('auth.login')
            ->with('message','La sesión ha sido cerrada con éxito')
            ->with('message_type','success');
    }

    private function getNoticia(int $id_noticia)
    {
        return Noticias::where('id_noticia', '=', $id_noticia)->first();
    }
}
