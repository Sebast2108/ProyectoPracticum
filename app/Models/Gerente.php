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
        'email',
        'user_id',  // Añadido para vincular con usuario
    ];

        /**
     * Relación: un paciente pertenece a un usuario (con rol paciente)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
