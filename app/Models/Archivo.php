<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',
    'archivo_type','MIME', 'ruta_archivo'];

    public function archivo(){
        return $this->belongsTo(User::class);
    }
}
