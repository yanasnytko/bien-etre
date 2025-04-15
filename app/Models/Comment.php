<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_provider_id',
        'title',
        'content',
        'date',     // Assure-toi d'utiliser dateTime('date') dans ta migration
        'rating',
        'is_abusive',
    ];

    // Un commentaire appartient à un utilisateur.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un commentaire appartient à un prestataire.
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    // Un commentaire peut avoir plusieurs abus (signalements).
    public function abuses()
    {
        return $this->hasMany(Abuse::class);
    }
}
