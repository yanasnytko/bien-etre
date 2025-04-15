<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieProposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'proposed_name',
        'description',
        'status',
    ];

    // Une proposition est liée à un utilisateur (prestataire) qui la soumet.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
