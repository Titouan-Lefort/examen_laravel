<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use App\Models\Spectacle;
use Illuminate\Http\Request;

class SpectacleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spectacles = Spectacle::with('salle')->orderBy('date_spectacle')->get();
        return view('spectacle.index', compact('spectacles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $salles = Salle::all();
        $selected_salle_id = $request->query('salle_id');
        return view('spectacle.create', compact('salles', 'selected_salle_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'salle_id' => 'required|exists:salle,id',
            'date_spectacle' => 'required|date|after:today',
            'heure_spectacle' => 'required',
            'prix' => 'required|numeric|min:0',
        ]);

        Spectacle::create($request->all());

        return redirect()->route('spectacle.index')->with('success', 'Spectacle ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $spectacle = Spectacle::findOrFail($id);
        $salles = Salle::all();
        return view('spectacle.edit', compact('spectacle', 'salles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'salle_id' => 'required|exists:salle,id',
            'date_spectacle' => 'required|date',
            'heure_spectacle' => 'required',
            'prix' => 'required|numeric|min:0',
        ]);

        $spectacle = Spectacle::findOrFail($id);
        $spectacle->update($request->all());

        return redirect()->route('salle.show', $spectacle->salle_id)->with('success', 'Spectacle mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spectacle = Spectacle::findOrFail($id);
        $spectacle->delete();

        return redirect()->route('spectacle.index')->with('success', 'Spectacle supprimé avec succès.');
    }
}
