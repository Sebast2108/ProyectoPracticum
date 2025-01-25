<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administrador';

    protected $fillable =[
        'nombre',
        'apellido',
        'id_administrador',
        'correo',
    ];
}
