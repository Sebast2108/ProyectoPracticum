<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reporte';

    protected $fillable =[
        'correo',
        'fechaGeneracion',
        'formato',
        'idReporte',
        'tipoReporte',
        
    ];
}
