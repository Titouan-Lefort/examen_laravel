<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $nom_salle
 * @property int $capacite
 * @property string $adresse
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Spectacle> $spectacles
 * @property-read int|null $spectacles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle whereCapacite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle whereNomSalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Salle whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Salle extends Model
{
    /** @use HasFactory<\Database\Factories\SalleFactory> */
    use HasFactory;

    protected $table = 'salle';

    protected $fillable = [
        'nom_salle',
        'capacite',
        'adresse',
    ];

    /**
     * @return HasMany<Spectacle, $this>
     */
    public function spectacles(): HasMany
    {
        return $this->hasMany(Spectacle::class);
    }
}
