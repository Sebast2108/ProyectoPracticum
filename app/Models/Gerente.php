<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gerente extends Model
{
    use HasFactory;

    protected $table = 'gerente';

    protected $fillable =[
        'nombre',
        'apellido',
        'id_gerente',
        'correo',
    ];
}
