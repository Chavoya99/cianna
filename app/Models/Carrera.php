<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function user_a(){
        return $this->belongsTo(UserA::class);
    }

    public function user_b(){
        return $this->belongsTo(UserB::class);
    }
}
