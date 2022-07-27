<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contacto extends Model
{
    protected $table = 'contacto';
    protected $primaryKey = 'id_contacto';

    protected $fillable = [
      'asunto',
      'mensaje',
      'id_verificado',
      'created_at',
      'updated_at'
    ];

    public static $reglas = [
        'asunto' => 'required|in:bloqueado,eventos,noticias,verificado,otro',
        'mensaje' => 'required',
        'id_verificado' => 'required|numeric'
    ];

    public static $mensajesDeError = [
      'asunto.required' => 'El campo de asunto no puede estar vacío',
      'asunto.in' => 'No ha seleccionado una opción válida',
      'mensaje.required' => 'El campo mensaje no puede estar vacío',
      'id_verificado.required' => 'Error al validar su usuario',
      'id_verificado.numeric' => 'Error al validar su número de usuario'
    ];


    public function verificado(): BelongsTo
    {
        return $this->belongsTo(Verificados::class, 'id_verificado','id_verificado');
    }
}
