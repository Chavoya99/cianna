<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserB extends Model
{
    use HasFactory;

    protected $table = 'users_b';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'edad','sexo', 'descripcion', 'mascota', 
    'num_mascotas','padecimiento', 'nom_padecimiento', 'lifestyle', 'carrera', 'codigo'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postulaciones(){
        return $this->hasMany(Postulacion::class, 'user_b_id');
    }

    public function favoritos_casas(){
        return $this->belongsToMany(Casa::class, 'favoritos_casas', 'user_b_id', 'casa_id');
    }

    public function favoritos_roomies(){
        return $this->belongsToMany(UserA::class, 'favoritos_roomies');
    }

}
