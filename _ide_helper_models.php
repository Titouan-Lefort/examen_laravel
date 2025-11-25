<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $salle_id
 * @property string|null $nom_spectacle
 * @property string $date_spectacle
 * @property string $heure_spectacle
 * @property string $prix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\salle|null $salle
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
 */
	class Spectacle extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $prenom
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Ability> $abilities
 * @property-read int|null $abilities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Silber\Bouncer\Database\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIs($role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsAll($role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsNot($role)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $numero_reservation
 * @property int $spectacle_id
 * @property int $user_id
 * @property int $nombre_personnes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Spectacle|null $spectacle
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation whereNombrePersonnes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation whereNumeroReservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation whereSpectacleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reservation whereUserId($value)
 */
	class reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom_salle
 * @property int $capacite
 * @property string $adresse
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Spectacle> $spectacles
 * @property-read int|null $spectacles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle whereCapacite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle whereNomSalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|salle whereUpdatedAt($value)
 */
	class salle extends \Eloquent {}
}

