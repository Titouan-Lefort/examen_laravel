<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $numero_reservation
 * @property int $spectacle_id
 * @property int $user_id
 * @property int $nombre_personnes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Spectacle|null $spectacle
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereNombrePersonnes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereNumeroReservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereSpectacleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Reservation extends Model
{
    protected $table = 'reservation';

    protected $fillable = [
        'numero_reservation',
        'spectacle_id',
        'user_id',
        'nombre_personnes',
    ];

    /**
     * @return BelongsTo<Spectacle, $this>
     */
    public function spectacle(): BelongsTo
    {
        return $this->belongsTo(Spectacle::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
