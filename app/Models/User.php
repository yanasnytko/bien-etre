<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname', 
        'firstname', 
        'email', 
        'password', 
        'register_date',
        'user_type',
        'newsletter',
        'trials',
        'is_provider',
        'is_banned',
        'is_verified',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // Ici, on laisse le champ "password" tel quel, 
        // Laravel 12 utilise maintenant l'option "hashed" lors de la définition des règles d'inscription,
        // mais pour le modèle, on peut simplement ne pas le déclarer, ou le laisser comme chaîne.
        // On peut donc omettre "password" ou le laisser (ce n'est pas obligatoire dans $casts)
        'register_date'     => 'datetime',
        'newsletter'        => 'boolean',
        'is_provider'       => 'boolean',
        'is_banned'         => 'boolean',
        'is_verified'       => 'boolean',
        'is_active'         => 'boolean',
    ];

    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function setNameAttribute($value)
    {
        $parts = explode(' ', trim($value), 2);
        $this->attributes['firstname'] = $parts[0] ?? '';
        $this->attributes['lastname']  = $parts[1] ?? '';
    }

    public function serviceProvider()
    {
        return $this->hasOne(\App\Models\ServiceProvider::class);
    }

    public function favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }

    public function address()
    {
        return $this->hasOne(\App\Models\Address::class);
    }

    public function primaryAddress()
    {
        return $this->hasOne(\App\Models\Address::class)->where('is_primary', true);
    }

}
