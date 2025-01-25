<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paciente = Paciente::all();
        return view('paciente.index', compact('paciente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_paciente' => 'required|integer|unique:paciente,id_paciente',
            'correo' => 'required|email|max:255|unique:paciente,correo',
            'historial_medico' => 'required|string|max:255',
        ]);

        Paciente::create($request->all());

        return redirect()->route('paciente.index')->with('success', 'Paciente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return view('paciente.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        return view('paciente.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_paciente' => 'required|integer|unique:paciente,id_paciente,' . $paciente->id,
            'correo' => 'required|email|max:255|unique:paciente,correo,' . $paciente->id,
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
        $paciente->delete();

        return redirect()->route('paciente.index')->with('success', 'Paciente eliminado exitosamente.');
    }
}
