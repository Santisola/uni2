<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use App\Models\Verificados;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $usuarios = Verificados::orderBy('updated_at','desc')->paginate(25);
        return view('usuarios.index', compact('usuarios'));
    }

    public function verificarUsuario(int $id_verificado): RedirectResponse
    {
        $usuarios = Verificados::findOrFail($id_verificado);

        try {
            if ($usuarios->status !== 1) {
                $usuarios->status = 1;
                $usuarios->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');

                $usuarios->save();

                return redirect()
                    ->route('usuarios')
                    ->with('message','Usuario verificado')
                    ->with('message_type','bg-green-300 text-green-800');
            } else {
                $usuarios->status = 0;
                $usuarios->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');

                $usuarios->save();

                return redirect()
                    ->route('usuarios')
                    ->with('message','Usuario disentido')
                    ->with('message_type','bg-green-300 text-green-800');
            }

        } catch (\Exception $exception) {
            return redirect()
                ->route('usuarios')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function usuarioEliminar(int $id_verificado): RedirectResponse
    {
        try {
            Verificados::findOrFail($id_verificado)->delete();

            return redirect()
                ->route('usuarios')
                ->with('message','Usuario eliminado')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('usuarios')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function listadoNoticias()
    {
        $noticias = Noticias::orderBy('created_at','desc')->paginate(25);
        return view('noticias.index', compact('noticias'));
    }

    public function noticiaForm()
    {
        return view('noticias.crearForm');
    }

    public function crear(Request $request): RedirectResponse
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
                "created_at" => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            ));

            return redirect()
                ->route('noticias')
                ->with('message','Noticia agregada')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('noticias.crearForm')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
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

    public function editar(Request $request, int $id_noticia): RedirectResponse
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
                    'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                ]);

            return redirect()
                ->route('noticias')
                ->with('message','Noticia Editada')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('noticias.crearForm')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function eliminar(int $id_eliminar): RedirectResponse
    {
        try {
            Noticias::findOrFail($id_eliminar)->delete();

            return redirect()
                ->route('noticias')
                ->with('message','Noticia Eliminada')
                ->with('message_type','bg-green-300 text-green-800');
        } catch (\Exception $exception) {
            return redirect()
                ->route('noticias.crearForm')
                ->with('message', 'No se pudo eliminar la noticia')
                ->with('message_type','bg-red-300 text-red-800');
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
                ->with('message_type','bg-red-300 text-red-800');
        }

        return redirect()
            ->route('home')
            ->with('message', '¡Bienvenido ' . Auth::user()->nombre . '!')
            ->with('message_type','bg-green-300 text-green-800');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()
            ->route('auth.login')
            ->with('message','La sesión ha sido cerrada con éxito')
            ->with('message_type','bg-green-300 text-green-800');
    }

    private function getNoticia(int $id_noticia)
    {
        return Noticias::where('id_noticia', '=', $id_noticia)->first();
    }
}
