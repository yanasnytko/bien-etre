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

    protected $casts = [
        'date_start'    => 'datetime',
        'date_end'      => 'datetime',
        'display_start' => 'datetime',
        'display_end'   => 'datetime',
    ];

    // Chaque promotion appartient à un prestataire.
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
