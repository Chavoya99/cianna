<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Chat;
use App\Models\User;
use App\Models\Archivo;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Ramsey\Uuid\Type\Integer;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Archivo::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('mostrar_chat', function(User $user, Chat $chat, $other_user_id, $roomId){
            

            if($user->tipo == 'A'){
                return $user->id == $chat->user_a_id 
                && $user->id != $other_user_id 
                && $chat->user_b_id == $other_user_id
                && $chat->room_id == $roomId
                ? Response::allow()
                : Response::denyWithStatus(404);
            }else if($user->tipo == 'B'){
                return $user->id == $chat->user_b_id 
                && $user->id != $other_user_id 
                && $chat->user_a_id == $other_user_id
                && $chat->room_id == $roomId
                ? Response::allow()
                : Response::denyWithStatus(404);
            }
        });

    }
}
