<?php

namespace App\Http\Controllers;

use DB;
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
        if(Auth::user()->tipo == "A"){
            $chats = Auth::user()->user_a->chats_a()
                ->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->orderBy('fecha_ultimo_mensaje', 'desc')->get();
        }else if(Auth::user()->tipo == "B"){
            $chats = Auth::user()->user_b->chats_b()
            ->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->orderBy('fecha_ultimo_mensaje', 'desc')->get();
        }

        $chats_obtenidos = [];
        foreach($chats as $chat){
            // Consulta directa a la tabla 'mensajes' para obtener el último mensaje
            $ultimoMensaje = DB::table('mensajes')
            ->where('chat_id', $chat->pivot->id)
            ->latest('fecha_hora')  // Ordena por la fecha más reciente
            ->first(); // Obtener solo el último mensaje

            $msj_descrifrado = "";
            if($ultimoMensaje){
                $msj_descrifrado = json_decode(($this->desencriptar_mensaje($ultimoMensaje->contenido)->getContent()))->mensaje_descifrado;
            }
            $chats_obtenidos[] = [
                'chat' => $chat, 
                'ultimoMensaje' => $ultimoMensaje,
                'contenido' => $msj_descrifrado
            ];
        }
        
        return view('lista_chats', compact('chats_obtenidos'));
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

    public function desencriptar_mensaje($contenido){

        $secretKey = env('SECRET_KEY');

        // Ejecutar el script de Node.js y capturar la salida
        $output = shell_exec("node " . base_path('server/desencriptar_mensaje.js') . " " . escapeshellarg($contenido) . " " . escapeshellarg($secretKey));
        
        return response()->json([
            'mensaje_descifrado' => trim($output) // Enviar el mensaje desencriptado a la vista
        ]);      
    }


}
