<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secretaria = Secretaria::with('user')->get();
        return view('secretaria.index', compact('secretaria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener usuarios con rol 'secretaria' que aún no tienen secretaria asignada
        $usuariosSecretaria = User::where('role', 'secretaria')
            ->doesntHave('secretaria')
            ->get();

        return view('secretaria.create', compact('usuariosSecretaria'));
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
            'email' => 'required|email|max:255|unique:secretaria,email',
            'user_id' => 'required|exists:users,id',
        ]);

        Secretaria::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'id_secretaria' => $request->id_secretaria,
            'email' => $request->email,
            'user_id' => $request->user_id,
        ]);

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
        // Incluir al usuario actual en la lista para edición
        $usuariosSecretaria = User::where('role', 'secretaria')
            ->where(function ($query) use ($secretaria) {
                $query->doesntHave('secretaria')->orWhere('id', $secretaria->user_id);
            })->get();

        return view('secretaria.edit', compact('secretaria', 'usuariosSecretaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secretaria $secretaria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_secretaria' => 'required|integer|unique:secretaria,id_secretaria,' . $secretaria->id . ',id',
            'email' => 'required|email|max:255|unique:secretaria,email,' . $secretaria->id . ',id',
            'user_id' => 'required|exists:users,id',
        ]);

        $secretaria->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'id_secretaria' => $request->id_secretaria,
            'email' => $request->email,
            'user_id' => $request->user_id,
        ]);

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
