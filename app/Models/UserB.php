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
        return $this->belongsToMany(Casa::class, 'postulaciones', 'user_b_id', 'casa_id')->withPivot('fecha', 'estado');
    }

    public function favoritos_casas(){
        return $this->belongsToMany(Casa::class, 'favoritos_casas', 'user_b_id', 'casa_id');
    }

    public function favoritos_roomies(){
        return $this->belongsToMany(UserA::class, 'favoritos_roomies');
    }

    public function chats_b(){
        return $this->belongsToMany(UserA::class, 'chats', 'user_b_id', 'user_a_id')->withPivot('id', 'room_id', 'fecha_hora_creacion','fecha_ultimo_mensaje');
    }


}
