<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'localite_id',
        'is_active',
    ];

    // Une adresse appartient à une localité.
    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
