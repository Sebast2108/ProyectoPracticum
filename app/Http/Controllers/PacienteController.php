<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User; // Necesario para obtener usuarios
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'paciente') {
            // Mostrar solo el paciente asociado al usuario autenticado
            $paciente = Paciente::where('user_id', $user->id)->get();
        } else {
            // Para otros roles, mostrar todos los pacientes
            $paciente = Paciente::all();
        }

        return view('paciente.index', compact('paciente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if (in_array($user->role, ['administrador', 'secretaria'])) {
            // Obtener usuarios con rol paciente para asignar al crear
            $usuariosPaciente = User::where('role', 'paciente')->get();
            return view('paciente.create', compact('usuariosPaciente'));
        }

        // Si no es admin ni secretaria, prohibir acceso
        abort(403, 'Acceso denegado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validación común
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_paciente' => 'required|integer|unique:paciente,id_paciente',
            'email' => 'required|email|max:255|unique:paciente,email',
            'historial_medico' => 'required|string|max:255',
        ];

        if (in_array($user->role, ['administrador', 'secretaria'])) {
            // Admin y secretaria deben enviar user_id válido
            $rules['user_id'] = 'required|exists:users,id';
        }

        $request->validate($rules);

        $data = $request->all();

        if ($user->role === 'paciente') {
            // Paciente sólo puede auto-asignarse
            $data['user_id'] = $user->id;
        }

        Paciente::create($data);

        return redirect()->route('paciente.index')->with('success', 'Paciente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        if (Auth::user()->role === 'paciente' && $paciente->user_id !== Auth::id()) {
            abort(403, 'Acceso denegado');
        }
        return view('paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        if (Auth::user()->role === 'paciente' && $paciente->user_id !== Auth::id()) {
            abort(403, 'Acceso denegado');
        }
        return view('paciente.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        if (Auth::user()->role === 'paciente' && $paciente->user_id !== Auth::id()) {
            abort(403, 'Acceso denegado');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_paciente' => 'required|integer|unique:paciente,id_paciente,' . $paciente->id,
            'email' => 'required|email|max:255|unique:paciente,email,' . $paciente->id,
            'historial_medico' => 'required|string|max:255',
        ]);

        $paciente->update($request->all());

        return redirect()->route('paciente.index')->with('success', 'Paciente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        if (Auth::user()->role === 'paciente' && $paciente->user_id !== Auth::id()) {
            abort(403, 'Acceso denegado');
        }

        $paciente->delete();

        return redirect()->route('paciente.index')->with('success', 'Paciente eliminado exitosamente.');
    }
}
