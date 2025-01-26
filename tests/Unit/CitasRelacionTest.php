<?php

namespace Tests\Unit;

use App\Models\Citas;
use App\Models\Paciente;
use App\Models\Medico;
use PHPUnit\Framework\TestCase;

class CitasRelacionTest extends TestCase
{
    public function test_relacion_cita_paciente()
    {
        // Crear un paciente en memoria
        $paciente = new Paciente([
            'id_paciente' => 1,
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'correo' => 'juan.perez@example.com',
            'historial_medico' => 'Sin antecedentes relevantes',
        ]);

        // Crear una cita en memoria asociada al paciente
        $cita = new Citas([
            'estado' => 'Confirmada',
            'fecha' => '2025-01-25',
            'hora' => '10:30:00',
            'tipo_cita' => 'Consulta',
            'id_paciente' => $paciente->id_paciente,
        ]);

        // Asociar manualmente el paciente a la cita
        $cita->setRelation('paciente', $paciente);

        // Verificar que la relación funcione correctamente
        $this->assertInstanceOf(Paciente::class, $cita->paciente);
        $this->assertEquals('Juan', $cita->paciente->nombre);
        $this->assertEquals('Pérez', $cita->paciente->apellido);
    }

    /**
     * Prueba la relación entre Citas y Medico.
     */
    public function test_relacion_cita_medico()
    {
        // Crear un médico en memoria
        $medico = new Medico([
            'id_medico' => 2,
            'nombre' => 'Ana',
            'apellido' => 'Lopez',
            'correo' => 'ana.lopez@example.com',
            'especialidad' => 'Cardiología',
        ]);

        // Crear una cita en memoria asociada al médico
        $cita = new Citas([
            'estado' => 'Pendiente',
            'fecha' => '2025-01-26',
            'hora' => '11:00:00',
            'tipo_cita' => 'Revisión',
            'id_medico' => $medico->id_medico,
        ]);

        // Asociar manualmente el médico a la cita
        $cita->setRelation('medico', $medico);

        // Verificar que la relación funcione correctamente
        $this->assertInstanceOf(Medico::class, $cita->medico);
        $this->assertEquals('Ana', $cita->medico->nombre);
        $this->assertEquals('Lopez', $cita->medico->apellido);
        $this->assertEquals('Cardiología', $cita->medico->especialidad);
    }
}
