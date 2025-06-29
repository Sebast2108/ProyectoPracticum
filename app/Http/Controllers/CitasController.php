<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitasController extends Controller
{
    /**
     * Listado de citas según el rol.
     */
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'paciente':
                // Paciente logueado ⇒ solo sus citas
                $paciente = Paciente::where('user_id', $user->id)->first();
                $cita = $paciente
                    ? Citas::with(['paciente', 'medico'])
                           ->where('id_paciente', $paciente->id)
                           ->get()
                    : collect();
                break;

            case 'medico':
                // Médico logueado ⇒ solo sus citas
                $medico = Medico::where('user_id', $user->id)->first();
                $cita = $medico
                    ? Citas::with(['paciente', 'medico'])
                           ->where('id_medico', $medico->id)
                           ->get()
                    : collect();
                break;

            default:
                // Otros roles ⇒ todas las citas
                $cita = Citas::with(['paciente', 'medico'])->get();
        }

        return view('citas.index', compact('cita'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        $user = Auth::user();

        // Paciente ve solo su registro; otros roles ven todos
        $paciente = $user->role === 'paciente'
            ? Paciente::where('user_id', $user->id)->get()
            : Paciente::all();

        // Todos los médicos para el selector
        $medico = Medico::with('especialidad')->get();

        return view('citas.create', compact('paciente', 'medico'));
    }

    /**
     * Guardar nueva cita.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'estado'       => 'required|string|max:255',
            'fecha'        => 'required|date|after_or_equal:today',
            'hora'         => 'required|date_format:H:i',
            'tipo_cita'    => 'required|string|max:255',
            'id_paciente'  => 'required|exists:paciente,id',
            'id_medico'    => 'required|exists:medico,id',
        ]);

        // Paciente solo agenda para sí mismo
        if ($user->role === 'paciente') {
            $pacienteUsuario = Paciente::where('user_id', $user->id)->first();
            if (!$pacienteUsuario || $pacienteUsuario->id != $request->id_paciente) {
                abort(403, 'No puedes agendar citas para otro paciente.');
            }
        }

        // Médico solo agenda para sí mismo (opcional)
        if ($user->role === 'medico') {
            $medicoUsuario = Medico::where('user_id', $user->id)->first();
            if (!$medicoUsuario || $medicoUsuario->id != $request->id_medico) {
                abort(403, 'No puedes agendar citas para otro médico.');
            }
        }

        Citas::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada con éxito.');
    }

    /**
     * Mostrar detalles de una cita.
     */
    public function show($id)
    {
        $cita = Citas::with(['paciente', 'medico'])->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    /**
     * Mostrar formulario para editar una cita.
     */
    public function edit($id)
    {
        $cita = Citas::findOrFail($id);
        $user = Auth::user();

        // Paciente solo puede editar si la cita está Pendiente
        if ($user->role === 'paciente' && $cita->estado !== 'Pendiente') {
            return redirect()->route('citas.index')
                             ->with('error', 'No puedes editar una cita que no esté en estado Pendiente.');
        }

        // Paciente solo carga su registro
        if ($user->role === 'paciente') {
            $paciente = Paciente::where('user_id', $user->id)->get();
        } else {
            $paciente = Paciente::all();
        }

        $medico = Medico::all();

        return view('citas.edit', compact('cita', 'paciente', 'medico'));
    }

    /**
     * Actualizar cita.
     */
    public function update(Request $request, $id)
    {
        $cita = Citas::findOrFail($id);
        $user = Auth::user();

        // Paciente solo puede actualizar si la cita está Pendiente
        if ($user->role === 'paciente' && $cita->estado !== 'Pendiente') {
            return redirect()->route('citas.index')
                             ->with('error', 'No puedes actualizar una cita que no esté en estado Pendiente.');
        }

        $request->validate([
            'estado'       => 'required|string|max:255',
            'fecha'        => 'required|date|after_or_equal:today',
            'hora'         => 'required|date_format:H:i',
            'tipo_cita'    => 'required|string|max:255',
            'id_paciente'  => 'required|exists:paciente,id',
            'id_medico'    => 'required|exists:medico,id',
        ]);

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada con éxito.');
    }

    /**
     * Eliminar cita.
     */
    public function destroy($id)
    {
        $cita = Citas::findOrFail($id);

        if ($cita->estado === 'Atendida') {
            return redirect()->route('citas.index')
                            ->with('error', 'No se puede eliminar una cita que esté en estado Atendida.');
        }

        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada con éxito.');
    }

    public function getAgendaMedico($medicoId, Request $request)
    {
        $fecha = $request->query('fecha');
        if (!$fecha) {
            return response()->json(['error' => 'Fecha no especificada'], 400);
        }

        $medico = Medico::find($medicoId);
        if (!$medico) {
            return response()->json(['error' => 'Médico no encontrado'], 404);
        }

        $userId = $medico->user_id;
        $diaSemana = ucfirst(\Carbon\Carbon::parse($fecha)->locale('es')->dayName);

        $agenda = Agenda::where('user_id', $userId)
            ->whereJsonContains('dias', $diaSemana)
            ->first(['hora_inicio', 'hora_fin']);

        if (!$agenda) {
            return response()->json(['error' => 'No hay agenda para este día'], 404);
        }

        // Obtener horas ya ocupadas (citas confirmadas o pendientes ese día)
        $horasOcupadas = Citas::where('id_medico', $medicoId)
            ->where('fecha', $fecha)
            ->whereIn('estado', ['Pendiente', 'Confirmada']) // considerar solo estados activos
            ->pluck('hora')
            ->toArray();

        return response()->json([
            'hora_inicio' => $agenda->hora_inicio,
            'hora_fin' => $agenda->hora_fin,
            'horas_ocupadas' => $horasOcupadas,
        ]);
    }

        public function getDiasAgendaMedico($medicoId)
    {
        $medico = Medico::find($medicoId);
        if (!$medico) {
            return response()->json(['error' => 'Médico no encontrado'], 404);
        }

        $agenda = Agenda::where('user_id', $medico->user_id)->first();

        if (!$agenda) {
            return response()->json(['dias' => []]);
        }

        return response()->json(['dias' => $agenda->dias]);
    }
}

