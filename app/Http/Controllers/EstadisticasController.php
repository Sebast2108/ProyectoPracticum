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
            'descripcion' => 'required|string|max:255',
            'idEstadistica' => 'required|integer|min:0',
            'valor' => 'required|double' ,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estadisticas $estadisticas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estadisticas $estadisticas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estadisticas $estadisticas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estadisticas $estadisticas)
    {
        //
    }
}
