<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_provider_id',
        'title',
        'description',
        'pdf',
        'date_start',
        'date_end',
        'display_start',
        'display_end',
        'is_active',
    ];

    // Chaque promotion appartient à un prestataire.
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
