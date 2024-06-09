<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoHabitacion extends Model
{
    use HasFactory;

    protected $table = 'archivos_habitaciones';
    
    protected $fillable = ['habitacion_id',
    'archivo_type','MIME', 'ruta_archivo'];

    public function habitacion(){
        return $this->belongsTo(Habitacion::class);
    }
}
