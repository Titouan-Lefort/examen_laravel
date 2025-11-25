<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpectacleRequest;
use App\Http\Requests\UpdateSpectacleRequest;
use App\Models\Salle;
use App\Models\Spectacle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpectacleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $spectacles = Spectacle::with('salle')->orderBy('date_spectacle')->get();

        return view('spectacle.index', compact('spectacles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $salles = Salle::all();
        $selected_salle_id = $request->query('salle_id');

        return view('spectacle.create', compact('salles', 'selected_salle_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpectacleRequest $request): RedirectResponse
    {
        Spectacle::create($request->all());

        return redirect()->route('spectacle.index')->with('success', 'Spectacle ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $spectacle = Spectacle::findOrFail($id);
        $salles = Salle::all();

        return view('spectacle.edit', compact('spectacle', 'salles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpectacleRequest $request, string $id): RedirectResponse
    {
        $spectacle = Spectacle::findOrFail($id);
        $spectacle->update($request->all());

        return redirect()->route('salle.show', $spectacle->salle_id)->with('success', 'Spectacle mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $spectacle = Spectacle::findOrFail($id);
        $spectacle->delete();

        return redirect()->route('spectacle.index')->with('success', 'Spectacle supprimé avec succès.');
    }
}
