<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'historial_medico',
        'id_paciente',
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
