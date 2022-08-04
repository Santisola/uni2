<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comentarios extends Model
{
    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentario';

    protected $fillable = [
       'comentario',
       'id_verificado',
       'id_noticia',
       'created_at',
       'updated_at'
    ];

    public static $reglas = [
        'comentario' => 'required'
    ];

    public static $mensajesDeError = [
        'comentario.required' => 'El comentario no puede estar vacío'
    ];

    public function verificado(): BelongsTo
    {
        return $this->belongsTo(Verificados::class, 'id_verificado','id_verificado')->withTrashed();
    }

    public function noticia(): BelongsTo
    {
        return $this->belongsTo(Noticias::class, 'id_noticia','id_noticia');
    }
}
