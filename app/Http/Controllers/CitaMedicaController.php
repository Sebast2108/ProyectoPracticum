<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
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
            'estado' => 'requiered|string|max:255'
            'fecha' => 'requiered|date'
            'hora' => 'requiered|time'
            'idCita' => 'requiered|string|max:255' 
            'tipoCita' => 'requiered|string|max:255' 
        ])
    }

    /**
     * Display the specified resource.
     */
    public function show(CitaMedica $citaMedica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CitaMedica $citaMedica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CitaMedica $citaMedica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitaMedica $citaMedica)
    {
        //
    }
}
