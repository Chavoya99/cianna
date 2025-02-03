<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Chat extends Model
{
    use HasUuids;
    
    protected $table = 'chats';
    public $timestamps = false;

    protected $fillable = ['user_a_id', 'user_b_id', 'room_id', 'fecha_hora_creacion', 'fecha_ultimo_mensaje'];

    public function chats_a(){
        return $this->belongsTo(UserA::class, 'chats', 'user_a_id', 'user_b_id')->withPivot('id', 'room_id', 'fecha_hora_creacion');
    }

    public function chats_b(){
        return $this->belongsTo(UserB::class, 'chats', 'user_b_id', 'user_a_id')->withPivot('id', 'room_id', 'fecha_hora_creacion');
    }
    

}
