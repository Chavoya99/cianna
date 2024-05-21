<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
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
