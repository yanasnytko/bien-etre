<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'province',
        'postal_code',
        'is_active',
    ];

    // Une localité a plusieurs adresses.
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
