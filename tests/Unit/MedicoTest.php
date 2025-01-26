<?php

namespace Tests\Unit;

use App\Models\Medico;
use PHPUnit\Framework\TestCase;

class MedicoTest extends TestCase
{

    public function test_crear_medico_en_memoria()
    {
        // Crear un médico en memoria
        $medico = new Medico([
            'nombre' => 'Ana',
            'apellido' => 'Gómez',
            'id_medico' => 78910,
            'correo' => 'ana.gomez@example.com',
            'especialidad' => 'Cardiología',
        ]);

        // Verificar que los atributos se asignaron correctamente
        $this->assertEquals('Ana', $medico->nombre);
        $this->assertEquals('Gómez', $medico->apellido);
        $this->assertEquals(78910, $medico->id_medico);
        $this->assertEquals('ana.gomez@example.com', $medico->correo);
        $this->assertEquals('Cardiología', $medico->especialidad);
    }
}
