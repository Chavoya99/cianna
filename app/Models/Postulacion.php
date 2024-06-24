<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;
    protected $table = 'postulaciones';

    public function user_b(){

        return $this->belongsTo(UserB::class, 'user_b_id');
        
    }

    public function habitacion(){

        return $this->belongsTo(Habitacion::class, 'habitacion_id');
        
    }
}
