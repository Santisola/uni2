<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';

    protected $primaryKey = 'id_alerta';

    public function especie(){
        return $this->belongsTo(Especie::class,'id_especie', 'id_especie');
    }

    public function raza(){
        return $this->belongsTo(Raza::class,'id_raza', 'id_raza');
    }

    public function sexo(){
        return $this->belongsTo(Sexo::class,'id_sexo', 'id_sexo');
    }

    public function tipoalerta(){
        return $this->belongsTo(Tipoalerta::class,'id_tipoalerta', 'id_tipoalerta');
    }
}
