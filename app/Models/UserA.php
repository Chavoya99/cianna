<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserA extends Model
{
    use HasFactory;
    
    protected $table = 'users_a';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'edad','sexo', 'descripcion', 'mascota', 
    'num_mascotas', 'padecimiento', 'nom_padecimiento', 'lifestyle', 'carrera', 'codigo'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function archivos(){
    //     return $this->morphMany(Archivo::class, 'archivable');
    // }

}
