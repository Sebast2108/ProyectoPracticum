<?php

namespace Tests\Feature;

use App\Models\Citas;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CitasTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

      /**
     * Prueba para registrar una cita.
     */
    public function test_crear_una_cita()
    {
        // Crear un paciente, médico para asociarlos con la cita
        $paciente = Paciente::factory()->create();
        $medico = Medico::factory()->create();


        // Datos simulados para crear la cita
        $datos = [
            'estado' => 'Programada',
            'fecha' => '2025-01-30',
            'hora' => '10:00:00',
            'tipo_cita' => 'Consulta',
            'id_paciente' => $paciente->id,
            'id_medico' => $medico->id,

        ];

        // Crear la cita en la base de datos
        $cita = Citas::create($datos);

        // Verificar que los datos existen en la base de datos
        $this->assertDatabaseHas('citas', $datos);
    }

    /**
     * Prueba para obtener una cita.
     */
    public function test_obtener_una_cita()
    {
        // Crear un paciente, médico para asociarlos con la cita
        $paciente = Paciente::factory()->create();
        $medico = Medico::factory()->create();


        // Crear una cita
        $cita = Citas::create([
            'estado' => 'Confirmada',
            'fecha' => '2025-02-01',
            'hora' => '14:00:00',
            'tipo_cita' => 'Urgente',
            'id_paciente' => $paciente->id,
            'id_medico' => $medico->id,

        ]);

        // Obtener la cita y verificar que los datos coinciden
        $citaEncontrada = Citas::find($cita->id);
        $this->assertEquals('Confirmada', $citaEncontrada->estado);
        $this->assertEquals('Urgente', $citaEncontrada->tipo_cita);
    }

    /**
     * Prueba para actualizar una cita.
     */
    public function test_actualizar_una_cita()
    {
        // Crear un paciente, médico para asociarlos con la cita
        $paciente = Paciente::factory()->create();
        $medico = Medico::factory()->create();


        // Crear una cita
        $cita = Citas::create([
            'estado' => 'Pendiente',
            'fecha' => '2025-03-01',
            'hora' => '09:00:00',
            'tipo_cita' => 'Revisión',
            'id_paciente' => $paciente->id,
            'id_medico' => $medico->id,

        ]);

        // Actualizar la cita
        $cita->update([
            'estado' => 'Confirmada',
            'fecha' => '2025-03-02',
            'hora' => '11:00:00',
        ]);

        // Verificar que los cambios se reflejan en la base de datos
        $this->assertDatabaseHas('citas', [
            'id' => $cita->id,
            'estado' => 'Confirmada',
            'fecha' => '2025-03-02',
            'hora' => '11:00:00',
        ]);
    }

    /**
     * Prueba para eliminar una cita.
     */
    public function test_eliminar_una_cita()
    {
        // Crear un paciente, médico para asociarlos con la cita
        $paciente = Paciente::factory()->create();
        $medico = Medico::factory()->create();


        // Crear una cita
        $cita = Citas::create([
            'estado' => 'Cancelada',
            'fecha' => '2025-04-01',
            'hora' => '16:00:00',
            'tipo_cita' => 'Emergencia',
            'id_paciente' => $paciente->id,
            'id_medico' => $medico->id,

        ]);

        // Eliminar la cita
        $cita->delete();

        // Verificar que la cita ya no está en la base de datos
        $this->assertDatabaseMissing('citas', [
            'id' => $cita->id,
        ]);
    }

    /**
     * Prueba para verificar las relaciones de la cita con otros modelos.
     */
    public function test_relaciones_con_paciente_medico()
    {
        // Crear un paciente y medico
        $paciente = Paciente::factory()->create();
        $medico = Medico::factory()->create();


        // Crear una cita
        $cita = Citas::create([
            'estado' => 'Programada',
            'fecha' => '2025-01-30',
            'hora' => '10:00:00',
            'tipo_cita' => 'Consulta',
            'id_paciente' => $paciente->id,
            'id_medico' => $medico->id,

        ]);

        // Verificar la relación con Paciente
        $this->assertEquals($paciente->id, $cita->paciente->id);

        // Verificar la relación con Medico
        $this->assertEquals($medico->id, $cita->medico->id);


    }
}
