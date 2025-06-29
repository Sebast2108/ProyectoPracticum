<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'medico') {
            // Mostrar solo el médico asociado al usuario autenticado
            $medico = Medico::where('user_id', $user->id)->get();
        } else {
            // Para otros roles, mostrar todos los médicos
            $medico = Medico::all();
        }

        return view('medico.index', compact('medico'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado');
        }

        $especialidad = Especialidad::all();
        $usuariosMedico = User::where('role', 'medico')->get();

        return view('medico.create', compact('especialidad', 'usuariosMedico'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_medico' => 'required|integer|unique:medico,id_medico',
            'email' => 'required|string|email|max:255|unique:medico,email',
            'id_especialidad' => 'required|exists:especialidad,id_especialidad',
            'user_id' => 'required|exists:users,id',
        ]);

        Medico::create($request->all());

        return redirect()->route('medico.index')->with('success', 'Médico creado exitosamente.');
    }

    public function show(Medico $medico)
    {
        $user = Auth::user();

        if ($user->role === 'medico' && $medico->user_id !== $user->id) {
            abort(403, 'Acceso denegado');
        }

        return view('medico.show', compact('medico'));
    }

    public function edit(Medico $medico)
    {
        if (Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado');
        }

        $especialidad = Especialidad::all();
        $usuariosMedico = User::where('role', 'medico')->get();

        return view('medico.edit', compact('medico', 'especialidad', 'usuariosMedico'));
    }

    public function update(Request $request, Medico $medico)
    {
        if (Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_medico' => 'required|integer|unique:medico,id_medico,' . $medico->id,
            'email' => 'required|string|email|max:255|unique:medico,email,' . $medico->id,
            'id_especialidad' => 'required|exists:especialidad,id_especialidad',
        ]);

        $medico->update($request->all());

        return redirect()->route('medico.index')->with('success', 'Médico actualizado exitosamente.');
    }

    public function destroy(Medico $medico)
    {
        if (Auth::user()->role !== 'administrador') {
            abort(403, 'Acceso denegado');
        }

        $medico->delete();

        return redirect()->route('medico.index')->with('success', 'Médico eliminado exitosamente.');
    }
}
