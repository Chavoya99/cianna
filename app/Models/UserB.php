<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserB extends Model
{
    use HasFactory;

    protected $table = 'users_b';
    protected $fillable = ['user_id', 'edad','sexo', 'descripcion', 'mascota', 
    'padecimiento', 'nom_padecimiento', 'lifestyle', 'carrera', 'codigo'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postulaciones(){
        return $this->hasMany(Postulacion::class);
    }

    // public function archivos(){
    //     return $this->hasMany(Archivo::class);
    // }
}
