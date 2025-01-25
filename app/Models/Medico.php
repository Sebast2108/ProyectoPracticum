<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';

    protected $fillable =[
        'nombre',
        'apellido',
        'id_medico',
        'correo',
        'especialidad',
    ];
}
