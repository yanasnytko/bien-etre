<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abuse extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'reported_by_user_id',
        'reason',
        'status',
    ];

    // Chaque abus est lié à un commentaire.
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // Identifie l'utilisateur qui a signalé l'abus.
    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by_user_id');
    }
}
