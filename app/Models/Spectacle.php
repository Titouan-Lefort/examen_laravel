<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $salle_id
 * @property string|null $nom_spectacle
 * @property string $date_spectacle
 * @property string $heure_spectacle
 * @property string $prix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\Salle|null $salle
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle whereDateSpectacle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle whereHeureSpectacle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle whereNomSpectacle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle whereSalleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Spectacle whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Spectacle extends Model
{
    /** @use HasFactory<\Database\Factories\SpectacleFactory> */
    use HasFactory;

    protected $fillable = [
        'salle_id',
        'nom_spectacle',
        'date_spectacle',
        'heure_spectacle',
        'prix',
    ];

    /**
     * @return BelongsTo<Salle, $this>
     */
    public function salle(): BelongsTo
    {
        return $this->belongsTo(Salle::class);
    }

    /**
     * @return HasMany<Reservation, $this>
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
