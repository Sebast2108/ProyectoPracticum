<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reporte = Reporte::all();
        return view('reporte.index', compact('reporte'));
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reporte.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|max:255',
            'fechaGeneracion' => 'required|date',
            'formato' => 'required|string|max:255',
            'idReporte' => 'required|integer|unique:reportes,idReporte',
            'tipoReporte' => 'required|string|max:255',
        ]);

        Reporte::create($request->all());

        return redirect()->route('reporte.index')->with('success', 'Reporte creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reporte $reporte)
    {
        return view('reporte.show', compact('reporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        return view('reporte.edit', compact('reporte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        $request->validate([
            'correo' => 'required|email|max:255',
            'fechaGeneracion' => 'required|date',
            'formato' => 'required|string|max:255',
            'idReporte' => 'required|integer|unique:reportes,idReporte,' . $reporte->id,
            'tipoReporte' => 'required|string|max:255',
        ]);

        $reporte->update($request->all());

        return redirect()->route('reporte.index')->with('success', 'Reporte actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return redirect()->route('reporte.index')->with('success', 'Reporte eliminado con éxito.');
    }
}
