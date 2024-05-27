<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habitacion extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $tabla = 'habitaciones';

    public function archivos(){
        return $this->morphMany(Archivo::class, 'archivable');
    }

    public function user_a(){
        return $this->belongsTo(UserA::class);
    }

    public function postulaciones(){
        return $this->morphMany(Postulacion::class, 'postulable');
    }
}
