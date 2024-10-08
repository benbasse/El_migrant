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
        'typesignalement_id',
        'user_id',
        'date'
    ];

    public function typeSignalement(){
        return $this->belongsTo(TypeSignalement::class, 'typesignalement_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
