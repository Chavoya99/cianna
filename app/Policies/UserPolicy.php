<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Archivo;
use Illuminate\Auth\Access\Response;


class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function descargar_archivo(User $usuario, Archivo $archivo){

        return $usuario->id == $archivo->user_id ? Response::allow() : Response::denyWithStatus(404);
    }
}
