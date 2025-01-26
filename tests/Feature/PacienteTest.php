<?php

namespace Tests\Feature;

use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PacienteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_crear_un_paciente()
    {
        // Datos simulados para crear un paciente
        $datos = [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'id_paciente' => '12345',
            'correo' => 'juan.perez@example.com',
            'historial_medico' => 'Sin antecedentes relevantes',
        ];

        // Crear el paciente en la base de datos
        $paciente = Paciente::create($datos);

        // Verificar que los datos existen en la base de datos
        $this->assertDatabaseHas('paciente', $datos);
    }

    /**
     * Prueba para obtener un paciente.
     */
    public function test_obtener_un_paciente()
    {
        // Crear un paciente de ejemplo
        $paciente = Paciente::factory()->create([
            'nombre' => 'Maria',
            'apellido' => 'Lopez',
            'id_paciente' => '456',
            'correo' => 'maria.lopez@example.com',
            'historial_medico' => 'Alergia a penicilina',
        ]);

        // Buscar el paciente por su ID
        $pacienteEncontrado = Paciente::find($paciente->id);

        // Verificar que los datos coinciden
        $this->assertEquals('Maria', $pacienteEncontrado->nombre);
        $this->assertEquals('Lopez', $pacienteEncontrado->apellido);
    }

    /**
     * Prueba para actualizar un paciente.
     */
    public function test_actualizar_un_paciente()
    {
        // Crear un paciente de ejemplo
        $paciente = Paciente::factory()->create([
            'nombre' => 'Carlos',
            'apellido' => 'Gomez',
            'id_paciente' => '789',
            'correo' => 'carlos.gomez@example.com',
            'historial_medico' => 'Diabetes tipo 2',
        ]);

        // Actualizar datos del paciente
        $paciente->update([
            'correo' => 'carlos.actualizado@example.com',
            'historial_medico' => 'Diabetes tipo 2, hipertensión',
        ]);

        // Verificar que los cambios se reflejan en la base de datos
        $this->assertDatabaseHas('paciente', [
            'id_paciente' => '789',
            'correo' => 'carlos.actualizado@example.com',
            'historial_medico' => 'Diabetes tipo 2, hipertensión',
        ]);
    }

    /**
     * Prueba para eliminar un paciente.
     */
    public function test_eliminar_un_paciente()
    {
        // Crear un paciente de ejemplo
        $paciente = Paciente::factory()->create([
            'nombre' => 'Ana',
            'apellido' => 'Martinez',
            'id_paciente' => '101',
            'correo' => 'ana.martinez@example.com',
        ]);

        // Eliminar el paciente
        $paciente->delete();

        // Verificar que el paciente ya no está en la base de datos
        $this->assertDatabaseMissing('paciente', [
            'id_paciente' => '101',
        ]);
    }
}
