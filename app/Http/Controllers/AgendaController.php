<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostrar solo las agendas del usuario autenticado
        $agenda = Agenda::where('user_id', Auth::id())->get();
        return view('agenda.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dias' => 'required|array|min:1',
            'dias.*' => 'string|max:255',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        Agenda::create([
            'dias' => $validatedData['dias'],
            'hora_inicio' => $validatedData['hora_inicio'],
            'hora_fin' => $validatedData['hora_fin'],
            'user_id' => Auth::id(), // Asociar al médico autenticado
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        // Proteger el acceso
        $this->authorizeAccess($agenda);
        return view('agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        $this->authorizeAccess($agenda);
        return view('agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $this->authorizeAccess($agenda);

        $validatedData = $request->validate([
            'dias' => 'required|array|min:1',
            'dias.*' => 'string|max:255',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        $agenda->update([
            'dias' => $validatedData['dias'],
            'hora_inicio' => $validatedData['hora_inicio'],
            'hora_fin' => $validatedData['hora_fin'],
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $this->authorizeAccess($agenda);
        $agenda->delete();
        return redirect()->route('agenda.index')->with('success', 'Agenda eliminada exitosamente.');
    }

    /**
     * Permite asegurar que un médico solo acceda a su propia agenda
     */
    private function authorizeAccess(Agenda $agenda)
    {
        if ($agenda->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para acceder a esta agenda.');
        }
    }
}
