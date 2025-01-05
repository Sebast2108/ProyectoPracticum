<?php

namespace App\Http\Controllers;

use App\Models\Gerencia;
use Illuminate\Http\Request;

class GerenciaController extends Controller
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
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'idGerente' => 'required|integer|min:0',
            'correo' => 'required|email|max:255' ,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gerencia $gerencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerencia $gerencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gerencia $gerencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerencia $gerencia)
    {
        //
    }
}
