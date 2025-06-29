<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'dias',
        'hora_inicio',
        'hora_fin',
        'user_id', // Campo que relaciona la agenda con un médico
    ];

    protected $casts = [
        'dias' => 'array',
    ];

    /**
     * Relación: una agenda pertenece a un usuario (médico)
     */
public function medico()
{
    return $this->belongsTo(Medico::class, 'user_id', 'user_id');
}

}
