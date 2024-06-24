<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoCasa extends Model
{
    use HasFactory;

    protected $table = 'archivos_casas';
    
    protected $fillable = ['casa_id',
    'clasificacion_foto','MIME', 'ruta_archivo'];

    public function casa(){
        return $this->belongsTo(Casa::class, 'casa_id');
    }
}
