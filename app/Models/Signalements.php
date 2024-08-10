<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signalements extends Model
{
    use HasFactory;

    protected $fillable = [
        'raison',
        'description',
        'statut',
        'type_signalement_id',
        "user_id"
    ];

    public function typeSignalement(){
        return $this->belongsTo(TypeSignalement::class, 'type_signalement_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
