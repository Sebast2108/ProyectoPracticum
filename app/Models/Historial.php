<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historial';

    protected $fillable = [
        'cita_id',       
        'sintomas',
        'diagnostico',
        'tratamientos',
        'observaciones',
    ];

    /**
     * Relación con la cita asociada al historial.
     */
    public function cita()
    {
        return $this->belongsTo(Citas::class, 'cita_id');
    }
}
