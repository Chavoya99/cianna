<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Casa extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    //protected $tabla = 'casas';
    protected $fillable = ['user_a_id','calle','num_ext','num_int','codigo_postal',
    'ciudad','colonia','descripcion','acepta_mascotas', 'acepta_visitas','riguroza_limpieza',
    'regla_adicional', 'muebles','servicios','requisitos', 'precio'];

    public function archivos(){
        return $this->hasMany(ArchivoCasa::class, 'casa_id');
    }

    public function user_a(){
        return $this->belongsTo(UserA::class, 'user_a_id');
    }

    public function postulaciones(){
        return $this->belongsToMany(UserB::class, 'postulaciones', 'user_b_id', 'casa_id')->withPivot('fecha');
    }

    public function favoritos_casas(){
        return $this->belongsToMany(UserB::class, 'favoritos_casas', 'user_b_id', 'casa_id');
    }
}
