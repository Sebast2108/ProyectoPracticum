<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Citas;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    /**
     * Listado del historial médico.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'paciente') {
            // Obtener el paciente vinculado al usuario
            $paciente = Paciente::where('user_id', $user->id)->first();

            // Obtener solo historiales de sus citas
            $historial = Historial::whereHas('cita', function ($query) use ($paciente) {
                    $query->where('id_paciente', $paciente->id);
                })
                ->with(['cita.medico.especialidad'])
                ->get();
        } else {
            // Médicos, secretarias, admin, etc. ven todo
            $historial = Historial::with(['cita.medico.especialidad'])->get();
        }

        return view('historial.index', compact('historial'));
    }

    /**
     * Formulario para crear historial (solo personal autorizado).
     */
    public function create(Request $request)
    {
        $this->verificarNoPaciente();

        $citaIdSeleccionada = $request->query('cita_id');
        $citas = Citas::with(['paciente', 'medico'])->where('estado', 'Atendida')->get();

        if ($citaIdSeleccionada && !$citas->contains('id', $citaIdSeleccionada)) {
            $cita = Citas::with(['paciente', 'medico'])->find($citaIdSeleccionada);
            if ($cita) {
                $citas->push($cita);
            }
        }

        return view('historial.create', compact('citas', 'citaIdSeleccionada'));
    }

    /**
     * Guardar nuevo historial (prohibido para pacientes).
     */
    public function store(Request $request)
    {
        $this->verificarNoPaciente();

        $request->validate([
            'cita_id'       => 'required|exists:citas,id',
            'sintomas'      => 'required|string|max:1000',
            'diagnostico'   => 'required|string|max:1000',
            'tratamientos'   => 'required|string|max:1000',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        Historial::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Historial médico creado con éxito.');
    }

    /**
     * Mostrar detalle de un historial (solo si pertenece al paciente).
     */
    public function show(Historial $historial)
    {
        $this->autorizarPacienteParaVer($historial);

        $historial->load('cita.medico.especialidad');
        return view('historial.show', compact('historial'));
    }

    /**
     * Editar historial (prohibido para pacientes).
     */
    public function edit(Historial $historial)
    {
        $this->verificarNoPaciente();

        $citas = Citas::with(['paciente', 'medico'])->where('estado', 'Atendida')->get();
        return view('historial.edit', compact('historial', 'citas'));
    }

    /**
     * Actualizar historial (prohibido para pacientes).
     */
    public function update(Request $request, Historial $historial)
    {
        $this->verificarNoPaciente();

        $request->validate([
            'cita_id'       => 'required|exists:citas,id',
            'sintomas'      => 'required|string|max:1000',
            'diagnostico'   => 'required|string|max:1000',
            'tratamientos'   => 'required|string|max:1000',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        $historial->update($request->all());

        return redirect()->route('historial.index')->with('success', 'Historial médico actualizado con éxito.');
    }

    /**
     * Eliminar historial (prohibido para pacientes).
     */
    public function destroy(Historial $historial)
    {
        $this->verificarNoPaciente();

        $historial->delete();
        return redirect()->route('historial.index')->with('success', 'Historial médico eliminado con éxito.');
    }

    /**
     * Verifica si el usuario no es paciente.
     */
    private function verificarNoPaciente()
    {
        if (Auth::user()->role === 'paciente') {
            abort(403, 'Acción no autorizada para pacientes.');
        }
    }

    /**
     * Permitir solo al paciente ver su propio historial.
     */
    private function autorizarPacienteParaVer(Historial $historial)
    {
        if (Auth::user()->role === 'paciente') {
            $paciente = Paciente::where('user_id', Auth::id())->first();
            if (!$paciente || $historial->cita->id_paciente !== $paciente->id) {
                abort(403, 'No autorizado para ver este historial.');
            }
        }
    }
}
