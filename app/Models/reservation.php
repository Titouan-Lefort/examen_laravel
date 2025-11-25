<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = [
        'numero_reservation',
        'salle_id',
        'user_id',
        'date_reservation',
        'heure_debut',
        'prix',
        'nombre_personnes',
    ];

    public function salle()
    {
        return $this->belongsTo(salle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
