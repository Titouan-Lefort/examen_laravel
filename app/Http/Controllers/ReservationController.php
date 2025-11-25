<?php

namespace App\Http\Controllers;

use App\Models\Spectacle;
use App\Models\Reservation;
use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all spectacles that are in the future
        $spectacles = Spectacle::where('date_spectacle', '>=', now()->toDateString())
            ->with('salle')
            ->orderBy('date_spectacle')
            ->orderBy('heure_spectacle')
            ->get();

        $availableSpectacles = $spectacles->map(function ($spectacle) {
            $totalReserved = $spectacle->reservations()->sum('nombre_personnes');
            $placesRestantes = $spectacle->salle->capacite - $totalReserved;

            if ($placesRestantes > 0) {
                return (object) [
                    'id' => $spectacle->id,
                    'salle' => $spectacle->salle,
                    'places_restantes' => $placesRestantes,
                    'date_spectacle' => $spectacle->date_spectacle,
                    'heure_spectacle' => $spectacle->heure_spectacle,
                    'prix' => $spectacle->prix,
                ];
            }
            return null;
        })->filter();

        return view('reservation.index', compact('availableSpectacles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Not used anymore for creating NEW slots, but maybe for reserving a specific spectacle?
        // Actually, the user flow is: Select a spectacle -> Reserve.
        // So we don't need a generic "create" that picks a room.
        // We need a "show" or "create" that takes a spectacle_id.

        // Let's redirect to index if accessed directly without params, or handle it.
        return redirect()->route('reservation.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'spectacle_id' => 'required|exists:spectacles,id',
            'nombre_personnes' => 'required|integer|min:1',
        ]);

        $spectacle = Spectacle::findOrFail($request->spectacle_id);
        $salle = $spectacle->salle;

        $currentReserved = $spectacle->reservations()->sum('nombre_personnes');

        if ($currentReserved + $request->nombre_personnes > $salle->capacite) {
            return back()->withErrors(['nombre_personnes' => 'Not enough seats available.']);
        }

        Reservation::create([
            'numero_reservation' => uniqid('RES-'),
            'spectacle_id' => $spectacle->id,
            'user_id' => Auth::id(),
            'nombre_personnes' => $request->nombre_personnes,
        ]);

        return redirect()->route('reservation.index')->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Show details of a SPECTACLE to reserve
        $spectacle = Spectacle::with('salle')->findOrFail($id);

        $totalReserved = $spectacle->reservations()->sum('nombre_personnes');
        $remainingPlaces = $spectacle->salle->capacite - $totalReserved;

        return view('reservation.show', compact('spectacle', 'remainingPlaces'));
    }    /**
     * Display a listing of the user's reservations.
     */
    public function myReservations()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['spectacle.salle'])
            ->get()
            ->sortByDesc(function($reservation) {
                return $reservation->spectacle->date_spectacle . ' ' . $reservation->spectacle->heure_spectacle;
            });

        return view('reservation.my_reservations', compact('reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::with(['spectacle.salle'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $spectacle = $reservation->spectacle;
        $salle = $spectacle->salle;

        // Calculate remaining places excluding this reservation's own count
        $totalReserved = $spectacle->reservations()
            ->where('id', '!=', $id)
            ->sum('nombre_personnes');

        $remainingPlaces = $salle->capacite - $totalReserved;

        return view('reservation.edit', compact('reservation', 'salle', 'remainingPlaces', 'spectacle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::with('spectacle.salle')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'nombre_personnes' => 'required|integer|min:1',
        ]);

        $spectacle = $reservation->spectacle;
        $salle = $spectacle->salle;

        // Check capacity
        $totalReserved = $spectacle->reservations()
            ->where('id', '!=', $id)
            ->sum('nombre_personnes');

        if ($totalReserved + $request->nombre_personnes > $salle->capacite) {
            return back()->withErrors(['nombre_personnes' => 'Not enough seats available for this update.']);
        }

        $reservation->update([
            'nombre_personnes' => $request->nombre_personnes,
        ]);

        return redirect()->route('reservation.my')->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $reservation->delete();

        return redirect()->route('reservation.my')->with('success', 'Reservation cancelled successfully.');
    }
}
