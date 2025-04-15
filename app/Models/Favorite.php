<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_provider_id',
    ];

    // Un favori appartient à un utilisateur.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un favori appartient à un prestataire.
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
