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
        $administrador = Administrador::all();
        return view('administrador.index', compact('administrador'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_administrador' => 'required|integer|unique:administrador,id_administrador',
            'correo' => 'required|email|max:255|unique:administrador,correo',
        ]);

        administrador::create($request->all());

        return redirect()->route('administrador.index')->with('success', 'administrador creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(administrador $administrador)
    {
        return view('administrador.show', compact('administrador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(administrador $administrador)
    {
        return view('administrador.edit', compact('administrador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, administrador $administrador)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_administrador' => 'required|integer|unique:administrador,id_administrador,' . $administrador->id,
            'correo' => 'required|email|max:255|unique:administrador,correo,' . $administrador->id,
        ]);

        $administrador->update($request->all());

        return redirect()->route('administrador.index')->with('success', 'administrador actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(administrador $administrador)
    {
        $administrador->delete();

        return redirect()->route('administrador.index')->with('success', 'administrador eliminado con éxito.');
    }
}
