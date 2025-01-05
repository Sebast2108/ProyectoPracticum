<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
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
            'nombre' => 'requiered|string|max:255'
            'apellido' => 'requiered|string|max:255'
            'idAdministrador' => 'requiered|integer|min:0'
            'correo' => 'requiered|string|max:255' 
        ])
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}
