<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalleRequest;
use App\Http\Requests\UpdateSalleRequest;
use App\Models\Salle;
use App\Models\Spectacle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $salles = Salle::all();

        return view('salle.index', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('salle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalleRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $salle = Salle::create([
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
        });

        return redirect()->route('salle.index')->with('success', 'Salle et spectacle créés avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle): View
    {
        $salle->load(['spectacles.reservations.user']);

        return view('salle.show', compact('salle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle): View
    {
        return view('salle.edit', compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalleRequest $request, Salle $salle): RedirectResponse
    {
        $salle->update($request->all());

        return redirect()->route('salle.index')->with('success', 'Salle mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle): RedirectResponse
    {
        $salle->delete();

        return redirect()->route('salle.index')->with('success', 'Salle supprimée avec succès.');
    }
}
