<?php

namespace App\Http\Controllers;

use App\Models\Gerente;
use Illuminate\Http\Request;

class GerenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gerente = Gerente::all();
        return view('gerente.index', compact('gerente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gerente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_gerente' => 'required|integer|unique:gerente,id_gerente',
            'correo' => 'required|email|max:255|unique:gerente,correo',
        ]);

        gerente::create($request->all());

        return redirect()->route('gerente.index')->with('success', 'Gerente creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(gerente $gerente)
    {
        return view('gerente.show', compact('gerente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(gerente $gerente)
    {
        return view('gerente.edit', compact('gerente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, gerente $gerente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_gerente' => 'required|integer|unique:gerente,id_gerente,' . $gerente->id,
            'correo' => 'required|email|max:255|unique:gerente,correo,' . $gerente->id,
        ]);

        $gerente->update($request->all());

        return redirect()->route('gerente.index')->with('success', 'Gerente actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gerente $gerente)
    {
        $gerente->delete();

        return redirect()->route('gerente.index')->with('success', 'Gerente eliminado con éxito.');
    }
}
