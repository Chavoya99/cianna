@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])

@section('title') {{ 'Chats | Todos' }} @endsection

<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    
    <div class="px-16 mt-8">
        <!-- Título -->
        <div class="text-3xl font-bold border-b border-gray-300 pb-4">
            Chats
        </div>
        
        <!-- Lista de chats -->
        <div class="mt-4 space-y-4">
            @foreach ($chats as $chat)
                @php
                    // Obtener la imagen del usuario
                    $imagen = $chat->user->archivos->first();

                    $idAuth = Auth::user()->id;

                    // Consulta directa a la tabla 'mensajes' para obtener el último mensaje
                    $ultimoMensaje = \DB::table('mensajes')
                        ->where('chat_id', $chat->pivot->id)
                        ->latest('fecha_hora')  // Ordena por la fecha más reciente
                        ->first(); // Obtener solo el último mensaje
                @endphp

                <!-- Contenedor del chat -->
                <div class="@if($loop->odd) bg-white @else bg-gray-100 @endif flex items-center 
                    gap-4 p-4 rounded-lg shadow-sm hover:bg-cianna-orange hover:shadow-md transition
                    hover:cursor-pointer" 
                    onclick="window.location.href='{{route('chat_privado', 
                    [$chat->pivot->id, $chat->pivot->room_id, $chat])}}'">
                    
                    <!-- Imagen de perfil -->
                    <div class="h-16 w-16 overflow-hidden rounded-full bg-cianna-orange">
                        <img class="object-cover w-full h-full" 
                            src="{{ asset('storage/'. $imagen->ruta_archivo) }}" 
                            alt="Vista previa de la imagen de perfil del roomie" />
                    </div>
                    
                    <!-- Información del chat -->
                    <div>
                        <p class="text-cianna-blue text-lg font-bold">
                            <!-- Nombre del compañero -->
                            {{$chat->user->name}}
                            {{--$idAuth--}}
                        </p>
                        <!-- Mostrar el último mensaje -->
                        @if ($ultimoMensaje)
                            <div class="text-sm text-gray-500">
                                <div class="flex">
                                    @if($idAuth == $ultimoMensaje->user_id_emisor)
                                        <p class="mr-1 font-bold"> Tú:</p>
                                    @endif
                                    <!-- Muestra los primeros 30 caracteres -->
                                    <p>{{ Str::limit($ultimoMensaje->contenido, 30) }}...</p> 
                                </div>
                                <!-- Fecha en formato "hace X minutos/horas" -->
                                <p class="text-xs">
                                    {{ \Carbon\Carbon::parse($ultimoMensaje->fecha_hora)->diffForHumans() }}
                                </p> 
                            </div>
                        @else
                            <!-- Si no hay mensajes -->
                            <div class="text-sm text-gray-500">No hay mensajes aún</div> 
                        @endif
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
</x-home-layout>
