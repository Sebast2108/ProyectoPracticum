<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medico';

    protected $fillable = [
        'nombre',
        'apellido',
        'id_medico',
        'email',
        'id_especialidad',
        'user_id', 
    ];

    /**
     * Relación con la especialidad (muchos a uno)
     */
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad', 'id_especialidad');
    }

    /**
     * Relación con la agenda (un médico tiene muchas agendas)
     */
    public function agenda()
    {
        return $this->hasMany(Agenda::class, 'user_id', 'user_id');
    }

    /**
     * Validar si la agenda está disponible para una fecha y hora dadas
     */
    public function agendaDisponible($fecha, $hora): bool
    {
        $diasSemanaMap = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        $diaSemana = $diasSemanaMap[$fecha->format('l')] ?? $fecha->format('l');
        $horaCita = Carbon::createFromFormat('H:i', $hora);

        foreach ($this->agenda as $agenda) {
            $dias = is_array($agenda->dias) ? $agenda->dias : json_decode($agenda->dias, true);
            $horaInicio = Carbon::createFromFormat('H:i', $agenda->hora_inicio);
            $horaFin = Carbon::createFromFormat('H:i', $agenda->hora_fin);

            if (in_array($diaSemana, $dias) && $horaCita->gte($horaInicio) && $horaCita->lt($horaFin)) {
                return true;
            }
        }
        return false;
    }
}
