<?php

namespace App\Http\Controllers;

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
            'fecha_hora_creacion' => now()
        ]);

        return redirect(route('lista_chats'));
    }
    
    public function mostrar_chat($chat_id, $room_id, $otherUserId){
        $chat = Chat::find($chat_id);
        
        Gate::authorize('mostrar_chat', [$chat, $otherUserId, $room_id]);

        
        return view('chatPrivado', compact('room_id', 'otherUserId', 'chat_id'));
    }

    public function lista_chats(){
        if(Auth::user()->tipo == "A"){
            $chats = Auth::user()->user_a->chats_a()
                ->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->get();
        }else if(Auth::user()->tipo == "B"){
            $chats = Auth::user()->user_b->chats_b()
            ->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->get();
        }
        //dd($chats);
        
        return view('lista_chats', compact('chats'));
    }

    public function redireccionar_chat($user_id_2){
        $user_id_1 = Auth::id();
        $users = [$user_id_1, intval($user_id_2)];
        rsort($users);
        $room_id = $users[0].'_'.$users[1];
        $chat_id = Chat::where('room_id', $room_id)->first('id');

        return redirect()->route('chat_privado', [$chat_id->id, $room_id, $user_id_2]);

    }


}
