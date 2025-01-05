<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    use HasFactory;

    protected $fillable =[
        'nombre'
        'apellido'
        'idSecretaria'
        'correo'
    ];
}
