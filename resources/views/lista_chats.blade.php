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

                    // Consulta directa a la tabla 'mensajes' para obtener el último mensaje
                    $ultimoMensaje = \DB::table('mensajes')
                        ->where('chat_id', $chat->pivot->id)
                        ->latest('fecha_hora')  // Ordena por la fecha más reciente
                        ->first(); // Obtener solo el último mensaje
                @endphp

                <!-- Contenedor del chat -->
                <div class="@if($loop->odd) bg-white @else bg-gray-100 @endif relative flex 
                    items-center gap-4 p-4 rounded-lg shadow-sm hover:bg-cianna-orange
                    hover:shadow-md transition hover:cursor-pointer group" 
                    onclick="window.location.href='{{route('chat_privado', 
                    [$chat->pivot->id, $chat->pivot->room_id, $chat])}}'">
                    
                    <!-- Imagen de perfil -->
                    <div class="h-20 w-20 overflow-hidden rounded-full bg-cianna-orange">
                        <img class="object-cover w-full h-full lazyload" 
                            data-src="{{ asset('storage/'. $imagen->ruta_archivo) }}" 
                            alt="Vista previa de la imagen de perfil del roomie" />
                    </div>
                    
                    <!-- Información del chat -->
                    <div>
                        <p class="text-cianna-blue text-xl font-bold group-hover:text-white">
                            <!-- Nombre del compañero -->
                            {{$chat->user->name}}
                        </p>
                        <!-- Mostrar el último mensaje -->
                        @if ($ultimoMensaje)
                            <div class="text-md text-gray-500 group-hover:text-white">
                                <div class="flex">
                                    @if(Auth::id() == $ultimoMensaje->user_id_emisor)
                                        <p class="mr-1 font-bold group-hover:text-white">Tú:</p>
                                    @endif
                                    <!-- Muestra los primeros 40 caracteres -->
                                    <p class="group-hover:text-white">
                                        {{ Str::limit($ultimoMensaje->contenido, 40) }}
                                    </p> 
                                </div>
                                <!-- Fecha en formato "hace X minutos/horas" -->
                                <p class="text-sm group-hover:text-white">
                                    {{ ucfirst(\Carbon\Carbon::parse($ultimoMensaje->fecha_hora)->
                                    diffForHumans()) }}
                                </p> 
                            </div>
                        @else
                            <!-- Si no hay mensajes -->
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 
                            text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                            NUEVO CHAT</span>
                            <div class="text-sm text-gray-500 group-hover:text-white">
                                No hay mensajes aún
                            </div> 
                        @endif
                    </div>
                    <a href="{{route('detalles_roomie', $chat->user->id)}}" 
                        class="absolute right-0 mr-4 rounded bg-cianna-orange group-hover:bg-white 
                        group-hover:text-black">
                        <div class="px-2 py-1 rounded hover:font-bold hover:bg-cianna-blue 
                            hover:text-white transition-transform transform hover:scale-110">
                            <i class="fa-solid fa-address-card mr-1"></i>
                            VER PERFIL
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative mt-4">
            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                rounded focus:outline-none focus:shadow-outline" 
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>
