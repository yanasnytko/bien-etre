<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logo',
        'company_name',
        'website',
        'company_email',
        'telephone',
        'vat_number',
        'creation_date',
        'description',
        'is_active',
    ];

    // Chaque prestataire appartient à un utilisateur.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation many-to-many avec les services (catégories)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_provider_service');
    }

    // Un prestataire peut proposer plusieurs stages.
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    // Un prestataire peut proposer plusieurs promotions.
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
