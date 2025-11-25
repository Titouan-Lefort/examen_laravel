<?php

namespace App\Http\Controllers;

use App\Models\salle;
use App\Models\Spectacle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salles = salle::all();
        return view('salle.index', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_salle' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'adresse' => 'required|string|max:255',
            // Spectacle validation
            'date_spectacle' => 'required|date',
            'heure_spectacle' => 'required',
            'prix' => 'required|numeric|min:0',
        ]);

        $salle = salle::create([
            'nom_salle' => $request->nom_salle,
            'capacite' => $request->capacite,
            'adresse' => $request->adresse,
        ]);

        Spectacle::create([
            'salle_id' => $salle->id,
            'date_spectacle' => $request->date_spectacle,
            'heure_spectacle' => $request->heure_spectacle,
            'prix' => $request->prix,
        ]);

        return redirect()->route('salle.index')->with('success', 'Salle et spectacle créés avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(salle $salle)
    {
        $salle->load(['spectacles.reservations.user']);
        return view('salle.show', compact('salle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salle $salle)
    {
        return view('salle.edit', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, salle $salle)
    {
        $request->validate([
            'nom_salle' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'adresse' => 'required|string|max:255',
        ]);

        $salle->update($request->all());

        return redirect()->route('salle.index')->with('success', 'Salle mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salle $salle)
    {
        $salle->delete();

        return redirect()->route('salle.index')->with('success', 'Salle supprimée avec succès.');
    }
}
