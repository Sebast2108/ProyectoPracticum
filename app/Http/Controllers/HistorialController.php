<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historial = historial::all();
        return view('historial.index', compact('historial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('historial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alergias' => 'required|string|max:255',
            'enfermedades_previas' => 'required|string|max:255',
            'id_historial' => 'required|integer|unique:historial_medicos,id_historial',
            'tratamientos' => 'required|string|max:255',
        ]);

        historial::create($request->all());

        return redirect()->route('historial.index')->with('success', 'Historial médico creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(historial $historial)
    {
        return view('historial.show', compact('historial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(historial $historial)
    {
        return view('historial.edit', compact('historial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, historial $historial)
    {
        $request->validate([
            'alergias' => 'required|string|max:255',
            'enfermedades_previas' => 'required|string|max:255',
            'id_historial' => 'required|integer|unique:historial_medicos,id_historial,' . $historial->id,
            'tratamientos' => 'required|string|max:255',
        ]);

        $historial->update($request->all());

        return redirect()->route('historial.index')->with('success', 'Historial médico actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(historial $historial)
    {
        $historial->delete();

        return redirect()->route('historial.index')->with('success', 'Historial médico eliminado con éxito.');
    }
}
