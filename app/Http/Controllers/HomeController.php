<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Salle;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // 1. Salles avec le nombre de réservations à venir
        $salles = Salle::with(['spectacles' => function ($query) {
            $query->where('date_spectacle', '>=', now());
        }, 'spectacles.reservations',
        ])->get();

        $sallesData = $salles->map(function ($salle) {
            $upcomingReservationsCount = $salle->spectacles->sum(function ($spectacle) {
                return $spectacle->reservations->count();
            });

            return (object) [
                'nom_salle' => $salle->nom_salle,
                'capacite' => $salle->capacite,
                'upcoming_reservations_count' => $upcomingReservationsCount,
            ];
        });

        // 2. Affichage par mois (Global)
        // On joint reservations -> spectacles pour avoir la date
        $monthlyStats = Reservation::join('spectacles', 'reservation.spectacle_id', '=', 'spectacles.id')
            ->select(
                DB::raw("DATE_FORMAT(spectacles.date_spectacle, '%Y-%m') as month"),
                DB::raw('COUNT(reservation.id) as total_reservations'),
                DB::raw('SUM(reservation.nombre_personnes) as total_seats')
            )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return view('index', compact('sallesData', 'monthlyStats'));
    }
}
