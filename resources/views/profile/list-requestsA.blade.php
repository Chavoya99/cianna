<!-- resources/views/profile/list-requestsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title') {{ 'Postulaciones | Todo' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl font-bold">Postulaciones recibidas</h1>
        </div>
        <div class="mt-2 ml-16">Aquí están todas las postulaciones que has recibido</div>
        <!-- MUESTRA DE POSTULACIONES-->
        <div class="mt-8 px-16 grid grid-cols-2 gap-6"> <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
            @foreach ($postulaciones as $postulacion)
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="inline-block w-full overflow-hidden flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="{{route('detalles_roomie', $postulacion)}}" class="w-1/2">
                            <img class="object-cover w-full h-full border border-cianna-gray rounded-md" 
                                src="{{ asset('storage/'. $postulacion->user->archivos->first()->ruta_archivo) }}"
                                alt="Imagen previa del roomie" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <!-- NOMBRE -->
                            <a href="{{route('detalles_roomie', $postulacion)}}" 
                                class="text-lg font-semibold line-clamp-1">
                                {{$postulacion->user->name.' '.$postulacion->user->apellido}}
                            </a>
                            <!-- CARRERA -->
                            <a href="{{route('detalles_roomie', $postulacion)}}" 
                            class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green font-semibold">
                                {{$carreras[$postulacion->carrera]}}
                            </a>
                            <!-- EDAD -->
                            <a href="{{route('detalles_roomie', $postulacion)}}" 
                                class="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                                {{$postulacion->edad}} años de edad
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="{{route('detalles_roomie', $postulacion)}}" 
                                class="text-sm text-justify line-clamp-3 mt-1">
                                {{$postulacion->descripcion}}
                            </a>
                            <!-- ESTADO POSTULACIÓN -->
                            <div class="mt-2">
                                <!-- FECHA DE POSTULACIÓN -->
                                <div class="flex">
                                    <p class="font-bold mr-1">Recibido: </p>
                                    {{ ucfirst(\Carbon\Carbon::parse($postulacion->pivot->fecha)->translatedFormat('d [\de ]M [\de ] Y')) }}
                                </div>
                                @php
                                    $estado_postulacion = $postulacion->pivot->estado;
                                @endphp
                                @if ($estado_postulacion == "pendiente")
                                    <div class="flex">
                                        <p class="font-bold">Estado:</p>
                                        <p class="ml-1 text-yellow-600 font-bold">Pendiente</p>
                                    </div>
                                    <div>
                                        <form action="{{route('aceptar_postulacion', $postulacion)}}" method="POST">
                                            @csrf
                                            <button class="px-2 py-1 mt-2 border rounded bg-cianna-green
                                                text-white font-bold hover:bg-lime-600" type="submit">
                                                <i class="fa-solid fa-circle-check mr-1"></i>Aceptar
                                            </button>
                                        </form>
                                    </div>
                                @elseif($estado_postulacion == "aceptada")
                                    <div class="flex">
                                        <p class="font-bold">Estado:</p>
                                        <p class="ml-1 text-cianna-green font-bold">Aceptada</p>
                                    </div>
                                    <div>
                                        <form action="{{route('ver_chat', $postulacion)}}" method="POST">
                                            @csrf
                                            <button class="px-2 py-1 mt-2 border rounded bg-cianna-blue 
                                                text-white font-bold hover:bg-sky-900" 
                                                type="submit">
                                                <i class="fa-solid fa-message mr-1"></i>Chat
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative px-20 mt-4">
            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                rounded focus:outline-none focus:shadow-outline" 
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>