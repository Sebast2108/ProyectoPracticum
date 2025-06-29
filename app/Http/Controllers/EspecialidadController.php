<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidad = Especialidad::all();
        return view('especialidad.index', compact('especialidad'));
    }

    public function create()
    {
        return view('especialidad.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Especialidad::create($request->only('nombre', 'descripcion'));

        return redirect()->route('especialidad.index')
                         ->with('success', 'Especialidad creada correctamente.');
    }

    public function show(Especialidad $especialidad)
    {
        return view('especialidad.show', compact('especialidad'));
    }

    public function edit(Especialidad $especialidad)
    {
        return view('especialidad.edit', compact('especialidad'));
    }

    public function update(Request $request, Especialidad $especialidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $especialidad->update($request->only('nombre', 'descripcion'));

        return redirect()->route('especialidad.index')
                         ->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();

        return redirect()->route('especialidad.index')
                         ->with('success', 'Especialidad eliminada correctamente.');
    }
}

