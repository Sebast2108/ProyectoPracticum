<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'estado',
        'fecha',
        'hora',
        'tipo_cita',
        'id_paciente',
        'id_medico',
        'id_historial',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico');
    }

    public function historial()
    {
        return $this->belongsTo(Historial::class, 'id_historial');
    }
}
