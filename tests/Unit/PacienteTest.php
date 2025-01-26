<?php

namespace Tests\Unit;

use App\Models\Paciente;
use PHPUnit\Framework\TestCase;

class PacienteTest extends TestCase
{

    public function test_crear_paciente_en_memoria()
    {
        // Crear un paciente en memoria
        $paciente = new Paciente([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'id_paciente' => 123456,
            'correo' => 'juan.perez@example.com',
            'historial_medico' => 'Historial de ejemplo',
        ]);

        // Verificar que los atributos se asignaron correctamente
        $this->assertEquals('Juan', $paciente->nombre);
        $this->assertEquals('Pérez', $paciente->apellido);
        $this->assertEquals(123456, $paciente->id_paciente);
        $this->assertEquals('juan.perez@example.com', $paciente->correo);
        $this->assertEquals('Historial de ejemplo', $paciente->historial_medico);
    }

}
