<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;
    protected $fillable = ['autor', 'reportado', 'motivo', 'fecha_hora'];
    public $timestamps = false;

    public function autor()
    {
        return $this->morphTo();
    }

    public function reportado()
    {
        return $this->morphTo();
    }
}
