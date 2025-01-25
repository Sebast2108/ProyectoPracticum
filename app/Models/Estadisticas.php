<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadisticas extends Model
{
    use HasFactory;

    protected $table = 'estadisticas';

    protected $fillable =[
        'descripcion',
        'id_estadistica',
        'valor',
    ];
}
