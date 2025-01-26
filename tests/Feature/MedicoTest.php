<?php

namespace Tests\Feature;

use App\Models\Medico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MedicoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_crear_un_medico()
    {
        // Datos simulados para crear un médico
        $datos = [
            'nombre' => 'Luis',
            'apellido' => 'González',
            'id_medico' => '321',
            'correo' => 'luis.gonzalez@example.com',
            'especialidad' => 'Cardiología',
        ];

        // Crear el médico en la base de datos
        $medico = Medico::create($datos);

        // Verificar que los datos existen en la base de datos
        $this->assertDatabaseHas('medico', $datos);
    }

    /**
     * Prueba para obtener un médico.
     */
    public function test_obtener_un_medico()
    {
        // Crear un médico de ejemplo
        $medico = Medico::factory()->create([
            'nombre' => 'Ana',
            'apellido' => 'Martínez',
            'id_medico' => '654',
            'correo' => 'ana.martinez@example.com',
            'especialidad' => 'Pediatría',
        ]);

        // Buscar el médico por su ID
        $medicoEncontrado = Medico::find($medico->id);

        // Verificar que los datos coinciden
        $this->assertEquals('Ana', $medicoEncontrado->nombre);
        $this->assertEquals('Martínez', $medicoEncontrado->apellido);
    }

    /**
     * Prueba para actualizar un médico.
     */
    public function test_actualizar_un_medico()
    {
        // Crear un médico de ejemplo
        $medico = Medico::factory()->create([
            'nombre' => 'Carlos',
            'apellido' => 'Lopez',
            'id_medico' => '987',
            'correo' => 'carlos.lopez@example.com',
            'especialidad' => 'Neurología',
        ]);

        // Actualizar datos del médico
        $medico->update([
            'correo' => 'carlos.actualizado@example.com',
            'especialidad' => 'Neurocirugía',
        ]);

        // Verificar que los cambios se reflejan en la base de datos
        $this->assertDatabaseHas('medico', [
            'id_medico' => '987',
            'correo' => 'carlos.actualizado@example.com',
            'especialidad' => 'Neurocirugía',
        ]);
    }

    /**
     * Prueba para eliminar un médico.
     */
    public function test_eliminar_un_medico()
    {
        // Crear un médico de ejemplo
        $medico = Medico::factory()->create([
            'nombre' => 'Raul',
            'apellido' => 'Fernández',
            'id_medico' => '852',
            'correo' => 'raul.fernandez@example.com',
            'especialidad' => 'Cirugía',
        ]);

        // Eliminar el médico
        $medico->delete();

        // Verificar que el médico ya no está en la base de datos
        $this->assertDatabaseMissing('medico', [
            'id_medico' => '852',
        ]);
    }
}
