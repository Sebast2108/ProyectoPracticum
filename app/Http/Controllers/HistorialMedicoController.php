<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alergias' => 'requiered|string|max:255',
            'enfermedadesPrevias' => 'requiered|string|max:255',
            'idHistorial' => 'requiered|integer|min:0',
            'tratamientos' => 'requiered|string|max:255',

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(HistorialMedico $historialMedico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialMedico $historialMedico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialMedico $historialMedico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialMedico $historialMedico)
    {
        //
    }
}
