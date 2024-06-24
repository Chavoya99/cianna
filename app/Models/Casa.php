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

    public function archivos(){
        return $this->hasMany(ArchivoCasa::class, 'casa_id');
    }

    public function user_a(){
        return $this->belongsTo(UserA::class, 'user_a_id');
    }

    public function postulaciones(){
        return $this->hasMany(Postulacion::class, 'casa_id');
    }
}
