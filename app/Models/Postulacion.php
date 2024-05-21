<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;
    protected $table = 'postulaciones';

    public function postulable(){

        return $this->morphTo(__FUNCTION__,'postulable_id', 'postulable_type');
        
    }
}
