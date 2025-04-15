<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'type', // Assure-toi que ce champ correspond bien à l'énumération définie dans ta migration
        'name',
    ];

    // Relation polymorphique : une image peut appartenir à différents modèles.
    public function imageable()
    {
        return $this->morphTo();
    }
}
