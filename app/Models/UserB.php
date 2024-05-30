<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserB extends Model
{
    use HasFactory;

    protected $table = 'users_b';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postulaciones(){
        return $this->hasMany(Postulacion::class);
    }

    public function archivos(){
        return $this->morphMany(Archivo::class, 'archivable');
    }

    public function carrera(){
        return $this->hasOne(Carrera::class);
    }
}
