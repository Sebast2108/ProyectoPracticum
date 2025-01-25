<?php

namespace App\Http\Controllers;

use App\Models\Estadisticas;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estadisticas = Estadisticas::all();
        return view('estadisticas.index', compact('estadisticas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estadisticas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'id_estadistica' => 'required|integer|unique:estadisticas,id_estadistica',
            'valor' => 'required|numeric',
        ]);

        Estadisticas::create($request->all());

        return redirect()->route('estadisticas.index')->with('success', 'Estadística creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estadisticas $estadistica)
    {
        return view('estadisticas.show', compact('estadistica'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estadisticas $estadistica)
    {
        return view('estadisticas.edit', compact('estadistica'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estadisticas $estadistica)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'id_estadistica' => 'required|integer|unique:estadisticas,id_estadistica,' . $estadistica->id,
            'valor' => 'required|numeric',
        ]);

        $estadistica->update($request->all());

        return redirect()->route('estadisticas.index')->with('success', 'Estadística actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estadisticas $estadistica)
    {
        $estadistica->delete();

        return redirect()->route('estadisticas.index')->with('success', 'Estadística eliminada con éxito.');
    }
}
