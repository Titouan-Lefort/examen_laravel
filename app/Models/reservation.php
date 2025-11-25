<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = [
        'numero_reservation',
        'spectacle_id',
        'user_id',
        'nombre_personnes',
    ];

    public function spectacle()
    {
        return $this->belongsTo(Spectacle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
