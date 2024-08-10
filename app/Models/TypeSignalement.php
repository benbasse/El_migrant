<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSignalement extends Model
{
    use HasFactory;

    protected $fillable = [
        "titre",
        "description"
    ];

    public function signalement(){
        return $this->hasMany(Signalements::class, "type_signalments_id");
    }
}
