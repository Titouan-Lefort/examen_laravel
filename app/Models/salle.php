<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class salle extends Model
{
    protected $table = 'salle';

    protected $fillable = [
        'nom_salle',
        'capacite',
        'adresse',
    ];

    public function spectacles()
    {
        return $this->hasMany(Spectacle::class);
    }
}
