<!-- resources/views/profile/favs.blade.php -->
@props(['defaultProfileImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{ 'Favoritos' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="font-bold text-3xl">Mis favoritos</h1>
        </div>
        <!-- MUESTRA DE HOGARES -->
        <div class="mt-8 px-16 grid grid-cols-2 gap-6"> <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
            @for ($i = 0; $i < 10; $i++) <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="ver_mas_hogar" class="w-1/2">
                            <img class="object-contain w-full h-full border border-cianna-gray bg-white rounded-lg" 
                                 src="{{ $defaultProfileImage }}" 
                                 alt="Imagen previa del hogar" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <p class="absolute right-0 top-0 text-cianna-orange"><i class="fa-solid fa-star mt-1 mr-2"></i> Favoritos</p>
                            <!-- COLONIA -->
                            <a href="ver_mas_hogar" class="text-lg font-semibold line-clamp-1">
                                Roomie {{ $i }}
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="ver_mas_hogar" class="text-sm text-justify line-clamp-3">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                Curabitur sed justo nec tortor laoreet porttitor et ut massa. 
                                Nam eget orci vestibulum velit tristique gravida ut eget massa. 
                                Aenean ultrices in tellus vel dapibus. 
                                Nam elementum, dui a tempor viverra, mauris ante interdum eros, in vestibulum.
                            </a>
                        </div>
                        
                    </div>
                </div>
            @endfor
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
