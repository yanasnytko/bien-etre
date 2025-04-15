<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider_id',
        'name',
        'description',
        'date_start',
        'date_end',
        'display_start',
        'display_end',
        'cost',
        'currency',
        'image',
        'is_active',
    ];

    // Chaque stage appartient à un prestataire.
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
