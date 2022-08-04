<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\AlertaImg;
use App\Models\Contacto;
use App\Models\Eventos;
use App\Models\Noticias;
use App\Models\Usuarios;
use App\Models\Verificados;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $a = Verificados::latest()
            ->take(5)
            ->get();

        $b = Eventos::where('publicado',true)
            ->latest()
            ->with('verificado')
            ->take(5)
            ->get();

        $c = Alerta::latest()
            ->take(5)
            ->with(['tipoalerta', 'especie', 'raza', 'sexo', 'usuario'])
            ->get();

        $output = [];
        foreach ($c as $alerta){
            if($alerta->usuario){
                $imgs = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);
                $formatImgs = [];
                foreach($imgs as $img){
                    $formatImgs[] = $img->imagen;
                }

                $alerta['imagenes'] = $formatImgs;


                $output[] = $alerta;
            }
        }



        $d = Usuarios::latest()
            ->take(5)
            ->get();

        $results = new Collection;
        $results = $results->mergeRecursive($a);
        $results = $results->mergeRecursive($b);
        $results = $results->mergeRecursive($output);
        $results = $results->mergeRecursive($d);
        $results = $results->sortByDesc('created_at');

        return view('home', compact('results'));
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function listadoEventos(Request $request)
    {
        $seleccionado = null;
        if ($request->eventos === 'eliminados') {
            $seleccionado = 'eliminados';

            $eventos = Eventos::onlyTrashed()
                ->where('publicado', true)
                ->with('verificado')
                ->orderBy('created_at', 'DESC')
                ->paginate(25);

        } elseif ($request->eventos === 'no-eliminados') {
            $seleccionado = 'desbloqueados';

            $eventos = Eventos::where('publicado', true)
                ->with('verificado')
                ->orderBy('created_at', 'DESC')
                ->paginate(25);

        } else {
            $eventos = Eventos::where('publicado', true)
                ->with('verificado')
                ->orderBy('created_at', 'DESC')
                ->withTrashed()
                ->paginate(25);
        }

        return view('eventos.index', compact('eventos', 'seleccionado'));
    }

    public function detalleEvento(int $id_evento)
    {
        $evento = Eventos::withTrashed()->findOrFail($id_evento);
        return view('eventos.detalle', compact('evento'));
    }

    public function detalleAlerta(int $id_alerta)
    {
        $alerta = Alerta::findOrFail($id_alerta);

        $imgs = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);
        $formatImgs = [];
        foreach($imgs as $img){
            $formatImgs[] = $img->imagen;
        }

        $alerta['imagenes'] = $formatImgs;

        return view('alertas.detalle', compact('alerta'));
    }

    public function eliminarEvento(int $evento): RedirectResponse
    {
        try {
            Eventos::findOrFail($evento)->delete();

            return redirect()
                ->route('eventos')
                ->with('message','Evento bloqueado')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('eventos')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function eventosDesbloquear(int $id_evento): RedirectResponse
    {
        try {
            $evento = Eventos::onlyTrashed()->findOrFail($id_evento);
            $evento->restore();

            return redirect()
                ->route('eventos')
                ->with('message','Evento desbloqueado')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('eventos')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function listadoAlertas()
    {
        $allAlertas = Alerta::orderBy('created_at', 'DESC')
            ->with(['tipoalerta','raza','especie','sexo'])
            ->paginate(25);

        $alertas = [];
        foreach ($allAlertas as $alerta){
            if($alerta->usuario){
                $imgs = AlertaImg::all()->where('id_alerta', $alerta->id_alerta);
                $formatImgs = [];
                foreach($imgs as $img){
                    $formatImgs[] = $img->imagen;
                }

                $alerta['imagenes'] = $formatImgs;

                $alertas[] = $alerta;
            }
        }

        return view('alertas.index', compact('alertas'));
    }

    public function listadoVerificados(Request $request)
    {
        $seleccionado = null;
        if (isset($request->usuarios)) {
            $seleccionado = $request->usuarios;
            if ($request->usuarios === 'eliminados') {
                $usuarios = Verificados::orderBy('updated_at','desc')
                    ->onlyTrashed()
                    ->paginate(25);

            } else if($request->usuarios === 'verificados') {
                $usuarios = Verificados::where('status',true)->paginate(25);
            } else if($request->usuarios === 'no-verificados') {
                $usuarios = Verificados::where('status',false)->paginate(25);

            } else {
                $usuarios = Verificados::orderBy('updated_at','desc')->withTrashed()->paginate(25);
            }
        } else {
            $usuarios = Verificados::orderBy('updated_at','desc')->withTrashed()->paginate(25);
        }

        return view('verificados.index', compact('usuarios','seleccionado'));
    }

    public function listadoUsuarios(Request $request)
    {
        $seleccionado = null;
        if (isset($request->usuarios)) {
            $seleccionado = $request->usuarios;
            if ($request->usuarios === 'eliminados') {
                $usuarios = Usuarios::orderBy('updated_at','desc')
                    ->onlyTrashed()
                    ->paginate(25);
            } else {
                $usuarios = Usuarios::orderBy('updated_at','desc')->withTrashed()->paginate(25);
            }
        } else {
            $usuarios = Usuarios::orderBy('updated_at','desc')->withTrashed()->paginate(25);
        }

        return view('usuarios.index', compact('usuarios','seleccionado'));
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
                    ->route('verificados')
                    ->with('message','Usuario verificado')
                    ->with('message_type','bg-green-300 text-green-800');
            } else {
                $usuarios->status = 0;
                $usuarios->updated_at = Carbon::now('UTC')->format('Y-m-d H:i:s');

                $usuarios->save();

                return redirect()
                    ->route('verificados')
                    ->with('message','Usuario disentido')
                    ->with('message_type','bg-green-300 text-green-800');
            }

        } catch (\Exception $exception) {
            return redirect()
                ->route('verificados')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    /**
     * Verificar
     * @param int $id_verificado
     * @return RedirectResponse
     */
    public function verificadoEliminar(int $id_verificado): RedirectResponse
    {
        try {
            Verificados::findOrFail($id_verificado)->delete();

            return redirect()
                ->route('verificados')
                ->with('message','Usuario eliminado')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('verificados')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function verificadoRestaurar(int $id_verificado): RedirectResponse
    {
        try {
            $usuario = Verificados::onlyTrashed()->findOrFail($id_verificado);
            $usuario->restore();

            return redirect()
                ->route('verificados')
                ->with('message','Usuario restaurado')
                ->with('message_type','bg-green-300 text-green-800');

        } catch (\Exception $exception) {
            return redirect()
                ->route('verificados')
                ->with('message', $exception->getMessage())
                ->with('message_type','bg-red-300 text-red-800');
        }
    }

    public function listadoNoticias(Request $request)
    {
        $seleccionado = null;
        if (isset($request->titulo)) {
            $seleccionado = $request->titulo;
            $noticias = Noticias::where('titulo','Like', '%' . $request->titulo . '%')
                ->orderBy('created_at','DESC')
                ->paginate(25);
        } else {
            $noticias = Noticias::orderBy('created_at','desc')->paginate(25);
        }

        return view('noticias.index', compact('noticias', 'seleccionado'));
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
    $noticia = Noticias::findOrFail($id_noticia);

    $request->validate([
        'titulo'=>'required|min:3',
        'contenido'=>'required|min:20',
        'publicado' => 'required|integer|between:0,1'
    ],[
        'titulo.required'=>'El titulo de la noticia es obligatorio',
        'contenido.required'=>'El contenido de la noticia es obligatorio',
        'publicado.required' => 'El estado no puede estar vacío',
        'publicado.integer' => 'El estado debe ser un entero',
        'publicado.between' => 'El estado debe estar entre 0 y 1',
    ]);

    $noticia->titulo = $request->titulo;
    $noticia->contenido = $request->contenido;
    $noticia->publicado = $request->publicado;

    if ($request->hasFile('imagen')) {
        $request->validate(
        [
            'imagen'=>'required|mimes:jpeg,jpg,png|max:10000'
        ],
        [
            'imagen.required'=>'La imagen es obligatoria',
            'imagen.mimes'=>'La imagen debe ser formato jpeg, jpg o png',
            'imagen.max' => 'La imagen es muy pesada intente subir otra',
        ]);

        $file_name = md5(time()) . '_' . str_replace(' ','-',$request->imagen->getClientOriginalName());
        $request->imagen->move(public_path('/imgs/noticias'), $file_name);

        $noticia->imagen = $file_name;
    }

    if ($request->slug !== $noticia->slug) {
        $request->validate(
            [
                'slug'=>'required|unique:noticias',
            ],
            [
                'slug.required'=>'El slug es obligatorio',
                'slug.unique'=>'El slug debe ser único e irrepetible, quizás ya exista otro slug con este nombre',
            ]);

        $noticia->imagen = $request->slug;
    }

    $noticia->save();

    return redirect()
        ->route('noticias')
        ->with('message','Noticia Editada')
        ->with('message_type','bg-green-300 text-green-800');
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

    public function login(Request $request): RedirectResponse
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

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()
            ->route('auth.login')
            ->with('message','La sesión ha sido cerrada con éxito')
            ->with('message_type','bg-green-300 text-green-800');
    }

    public function listadoContacto()
    {
        $contactos = Contacto::orderBy('created_at','desc')
            ->with('verificado')
            ->paginate(25);

        return view('contacto.index', compact('contactos'));
    }

    public function detalleContacto(int $id_contacto)
    {
        $contacto = Contacto::with('verificado')
            ->findOrFail($id_contacto);

//        dd($contacto);

        return view('contacto.detalle', compact('contacto'));
    }

    private function getNoticia(int $id_noticia)
    {
        return Noticias::where('id_noticia', '=', $id_noticia)->first();
    }
}
