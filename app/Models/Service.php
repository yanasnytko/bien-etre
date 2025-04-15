<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'featured',
        'is_active',
    ];

    // Une catégorie peut être associée à plusieurs prestataires.
    public function serviceProviders()
    {
        return $this->belongsToMany(ServiceProvider::class, 'service_provider_service');
    }
}
