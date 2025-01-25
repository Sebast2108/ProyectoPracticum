<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Citas::with(['paciente', 'medico'])->get();
        return view('citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paciente = Paciente::all();
        $medico = Medico::all();
        return view('citas.create', compact('paciente', 'medico'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'tipo_cita' => 'required|string|max:255',
            'id_paciente' => 'required|exists:paciente,id',
            'id_medico' => 'required|exists:medico,id',
        ]);

        Citas::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $citas = Citas::with(['paciente', 'medico'])->findOrFail($id);
        return view('citas.show', compact('citas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $citas = Citas::findOrFail($id);
        $paciente = Paciente::all();
        $medico = Medico::all();
        return view('citas.edit', compact('citas', 'paciente', 'medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $citas = Citas::findOrFail($id);

        $request->validate([
            'estado' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'tipo_cita' => 'required|string|max:255',
            'id_paciente' => 'required|exists:paciente,id',
            'id_medico' => 'required|exists:medico,id',
        ]);

        $citas->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cita = Citas::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada con éxito.');
    }
}
