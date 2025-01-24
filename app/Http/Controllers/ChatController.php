<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    public function crear_chat(Request $request){
        $request->validate([
            'user_1_id' => 'required',
            'user_2_id' => 'required'
        ]);

        $roomId = $request->room_id;

        Chat::create([
            'user_a_id' => $request->user_1_id,
            'user_b_id' => $request->user_2_id,
            'room_id' => $roomId,
            'fecha_hora_creacion' => now('America/Belize'),
            'fecha_ultimo_mensaje' => '2000-1-1 00:00:00'
        ]);

        return redirect(route('lista_chats'));
    }
    
    public function mostrar_chat($chat_id, $room_id, $otherUserId){
        $chat = Chat::find($chat_id);
        
        Gate::authorize('mostrar_chat', [$chat, $otherUserId, $room_id]);

        
        return view('chatPrivado', compact('room_id', 'otherUserId', 'chat_id'));
    }

    public function lista_chats(){
        return view('lista_chats');
    }

    public function redireccionar_chat($id_aux){
        if(Auth::user()->tipo == 'A'){
            $user_id_1 = Auth::id();
            $users = [$user_id_1, intval($id_aux)];
            rsort($users);
            $room_id = $users[0].'_'.$users[1];
            $chat_id = Chat::where('room_id', $room_id)->first('id');
        }elseif(Auth::user()->tipo == 'B'){

            $casa = Casa::where('id', $id_aux)->first();

            $user_id_1 = $casa->user_a->user_id;
            $user_id_2 = Auth::id();
            $users = [$user_id_1, $user_id_2];
            rsort($users);
            $room_id = $users[0].'_'.$users[1];
            $chat_id = Chat::where('room_id', $room_id)->first('id');

            $id_aux = $user_id_1;
        }
        

        return redirect()->route('chat_privado', [$chat_id->id, $room_id, $id_aux]);

    }


}
