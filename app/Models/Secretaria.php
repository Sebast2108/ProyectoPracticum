<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    use HasFactory;
    
    protected $table = 'secretaria';

    protected $fillable =[
        'nombre',
        'apellido',
        'id_secretaria',
        'correo',
    ];
}
