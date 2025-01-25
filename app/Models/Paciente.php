<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';

    protected $fillable =[
        'nombre',
        'apellido',
        'id_paciente',
        'correo',
        'historial_medico',
    ];
}
