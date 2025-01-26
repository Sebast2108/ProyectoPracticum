<?php

namespace Tests\Unit;

use App\Models\Citas;
use PHPUnit\Framework\TestCase;

class CitasTest extends TestCase
{
    public function test_crear_citas_en_memoria()
    {
        // Crear una citas en memoria
        $citas = new Citas([
            'estado' => 'Pendiente',
            'fecha' => '2025-01-25',
            'hora' => '10:30:00',
            'tipo_cita' => 'Consulta',
            'id_paciente' => 1,
            'id_medico' => 2,
            'id_historial' => 3,
        ]);

        // Verificar que los atributos se asignaron correctamente
        $this->assertEquals('Pendiente', $citas->estado);
        $this->assertEquals('2025-01-25', $citas->fecha);
        $this->assertEquals('10:30:00', $citas->hora);
        $this->assertEquals('Consulta', $citas->tipo_cita);
        $this->assertEquals(1, $citas->id_paciente);
        $this->assertEquals(2, $citas->id_medico);
        $this->assertEquals(3, $citas->id_historial);
    }
}
