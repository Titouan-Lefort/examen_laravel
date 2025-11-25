<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spectacle extends Model
{
    protected $fillable = [
        'salle_id',
        'nom_spectacle',
        'date_spectacle',
        'heure_spectacle',
        'prix',
    ];

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
