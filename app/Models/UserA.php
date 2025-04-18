<?php

namespace App\Models;

use App\Models\Reporte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserA extends Model
{
    use HasFactory;
    
    protected $table = 'users_a';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'registro_completo', 'edad','sexo', 'descripcion', 'mascota', 
    'num_mascotas', 'padecimiento', 'nom_padecimiento', 'lifestyle', 'carrera', 'codigo'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function casa(){
        return $this->hasOne(Casa::class, 'user_a_id');
    }

    public function favoritos_roomies(){
        return $this->belongsToMany(UserB::class, 'favoritos_roomies', 'user_a_id', 'user_b_id');
    }

    public function chats_a(){
        return $this->belongsToMany(UserB::class, 'chats', 'user_a_id', 'user_b_id')->withPivot('id', 'room_id', 'fecha_hora_creacion', 'fecha_ultimo_mensaje');
    }

    public function reportesEnviados()
    {
        return $this->morphMany(Reporte::class, 'autor');
    }

    public function reportesRecibidos()
    {
        return $this->morphMany(Reporte::class, 'reportado');
    }

}
