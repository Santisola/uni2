<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaImg extends Model
{
    protected $table = 'alerta_imgs';

    protected $primaryKey = 'id_alerta_img';

    protected $fillable = [
        'imagen',
        'id_alerta'
    ];
}
