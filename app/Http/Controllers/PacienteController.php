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
        return view('paciente.create')
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'requiered|string|max:255'
            'apellido' => 'requiered|string|max:255'
            'idPaciente' => 'requiered|integer|min:0'
            'correo' => 'requiered|string|max:255' 
            'historialMedico' => 'requiered|string|max:255' 
        ])
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        /return view('paciente.index', compact('paciente'))
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
