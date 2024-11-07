<!-- resources/views/profile/roomies-list.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title') {{ 'Compañeros disponibles' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Más compañeros disponibles</h1>
        </div>
        <!-- MUESTRA DE ROOMIES -->
        <div class="mt-8 px-16 grid grid-cols-2 gap-6"> <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
            @foreach ($roomies as $roomie) <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="{{route('vista_previa_roomie', $roomie)}}" class="w-1/2">
                            <img class="object-cover w-full h-full border border-cianna-gray 
                                bg-white rounded-lg" 
                                src="{{ asset('storage/'.$roomie->user->archivos->first()->ruta_archivo) }}" 
                                alt="Imagen previa del roomie" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <!-- NOMBRE -->
                            <a href="{{route('vista_previa_roomie', $roomie)}}" 
                            class="text-lg font-semibold line-clamp-1">
                                {{$roomie->user->name.' '.$roomie->user->apellido}}
                            </a>
                            <!-- CARRERA -->
                            <a href="{{route('vista_previa_roomie', $roomie)}}" 
                            class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green 
                                font-semibold">
                                {{$carreras[$roomie->carrera]}}
                            </a>
                            <!-- EDAD -->
                            <a href="{{route('vista_previa_roomie', $roomie)}}" 
                            class="text-sm text-justify line-clamp-1 mt-1 text-gray-600 
                                font-semibold">
                                {{$roomie->edad}} años de edad
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="{{route('vista_previa_roomie', $roomie)}}" 
                            class="text-sm text-justify line-clamp-3 mt-1">
                                {{$roomie->descripcion}}
                            </a>
                        </div>
                        
                    </div>
                </div>
            @endforeach
            <br>
            {{--<div class="text-right mt-2">
                <a class="text-cianna-green font-semibold hover:text-cianna-orange absolute right-0 px-20" 
                    href="listado_favsA">Ver más...
                </a>
            </div>--}}
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