<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secretaria = Secretaria::all();
        return view('secretaria.index', compact('secretaria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('secretaria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_secretaria' => 'required|integer|unique:secretaria,id_secretaria',
            'correo' => 'required|email|max:255|unique:secretaria,correo',
        ]);

        Secretaria::create($request->all());

        return redirect()->route('secretaria.index')->with('success', 'Secretaria creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Secretaria $secretaria)
    {
        return view('secretaria.show', compact('secretaria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Secretaria $secretaria)
    {
        return view('secretaria.edit', compact('secretaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secretaria $secretaria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_secretaria' => 'required|integer|unique:secretaria,id_secretaria,' . $secretaria->id,
            'correo' => 'required|email|max:255|unique:secretaria,correo,' . $secretaria->id,
        ]);

        $secretaria->update($request->all());

        return redirect()->route('secretaria.index')->with('success', 'Secretaria actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secretaria $secretaria)
    {
        $secretaria->delete();

        return redirect()->route('secretaria.index')->with('success', 'Secretaria eliminada con éxito.');
    }
}
