<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medico = Medico::all();
        return view('medico.index', compact('medico'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_medico' => 'required|integer|unique:medico,id_medico',
            'correo' => 'required|string|email|max:255|unique:medico,correo',
            'especialidad' => 'required|string|max:255',
        ]);

        Medico::create($request->all());
        
        return redirect()->route('medico.index')->with('success', 'Médico creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $medico)
    {
        return view('medico.show', compact('medico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medico $medico)
    {
        return view('medico.edit', compact('medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_medico' => 'required|integer|unique:medico,id_medico,' . $medico->id,
            'correo' => 'required|string|email|max:255|unique:medico,correo,' . $medico->id,
            'especialidad' => 'required|string|max:255',
        ]);

        $medico->update($request->all());
        return redirect()->route('medico.index')->with('success', 'Médico actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        $medico->delete();
        
        return redirect()->route('medico.index')->with('success', 'Médico eliminado exitosamente.');
    }
}
