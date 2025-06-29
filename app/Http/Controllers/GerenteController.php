<?php

namespace App\Http\Controllers;

use App\Models\Gerente;
use App\Models\User;
use Illuminate\Http\Request;

class GerenteController extends Controller
{
    public function index()
    {
        $gerente = Gerente::all();
        return view('gerente.index', compact('gerente'));
    }

    public function create()
    {
        // Traemos usuarios con rol gerente para asignarlos
        $usuariosGerente = User::where('role', 'gerente')->get();

        return view('gerente.create', compact('usuariosGerente'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_gerente' => 'required|integer|unique:gerente,id_gerente',
            'email' => 'required|email|max:255|unique:gerente,email',
            'user_id' => 'required|exists:users,id',
        ]);

        Gerente::create($request->all());

        return redirect()->route('gerente.index')->with('success', 'Gerente creado con éxito.');
    }

    public function show(Gerente $gerente)
    {
        return view('gerente.show', compact('gerente'));
    }

    public function edit(Gerente $gerente)
    {
        $usuariosGerente = User::where('role', 'gerente')->get();

        return view('gerente.edit', compact('gerente', 'usuariosGerente'));
    }

    public function update(Request $request, Gerente $gerente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_gerente' => 'required|integer|unique:gerente,id_gerente,' . $gerente->id,
            'email' => 'required|email|max:255|unique:gerente,email,' . $gerente->id,
            'user_id' => 'required|exists:users,id',
        ]);

        $gerente->update($request->all());

        return redirect()->route('gerente.index')->with('success', 'Gerente actualizado con éxito.');
    }

    public function destroy(Gerente $gerente)
    {
        $gerente->delete();

        return redirect()->route('gerente.index')->with('success', 'Gerente eliminado con éxito.');
    }
}
