<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'favoriteable_id',
        'favoriteable_type',
    ];

    // Un favori appartient à un utilisateur.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation polymorphe qui retourne l'entité favorisée (peut être un ServiceProvider, Stage, Promotion, etc.)
    public function favoriteable()
    {
        return $this->morphTo();
    }
}
