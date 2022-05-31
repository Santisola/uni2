<?php

namespace App\Http\Controllers;

use App\Models\Noticias;
use Illuminate\Http\JsonResponse;

class NoticiasController extends Controller
{
    public function all() : JsonResponse
    {
        $noticias = Noticias::orderBy('created_at')->get();

        return response()->json([
           'success' => true,
           'noticias' => $noticias
        ]);
    }

    public function noticia(string $slug) : JsonResponse
    {
      $noticia =Noticias::all()
          ->where('slug', $slug)
          ->where('publicado',1)
          ->first();

      return response()->json([
          'success' => true,
          'noticia' => $noticia
      ]);
    }
}
