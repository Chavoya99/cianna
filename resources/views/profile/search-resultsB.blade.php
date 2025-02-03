<!-- resources/views/profile/search-resultsB.blade.php -->
@props(['defaultImage' => asset('img/img_prueba_casas/img_fachada.jpg')])
@section('title') {{ 'Resultados de la búsqueda' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Resultados de la búsqueda</h1>
        </div>
        <!-- MUESTRA DE HABITACIONES -->
        <div>
            <!-- MUESTRA DE HOGARES -->
            <div class="mt-8 px-16 grid grid-cols-2 gap-6"> <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
                @for ($i = 0; $i < 10; $i++) <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                    <div class="flex flex-col py-3 px-3 rounded-lg">
                        <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                        <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                            transition-transform transform hover:scale-105">
                            <!-- IMAGEN -->
                            <a href="vista_previa_casa" class="w-1/2">
                                <img class="object-cover w-full h-full border border-cianna-gray rounded-lg" 
                                src="{{ $defaultImage }}" 
                                alt="Imagen previa del hogar" />
                            </a>
                            <!-- ENLACES -->
                            <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                                <!-- COLONIA -->
                                <a href="vista_previa_casa" 
                                class="text-lg font-semibold line-clamp-1">
                                    COLONIA
                                </a>
                                <!-- DESCRIPCIÓN -->
                                <a href="vista_previa_casa" 
                                class="text-sm text-justify line-clamp-3">
                                    DESCRIPCIÓN
                                </a>
                                <!-- PRECIO -->
                                <a href="vista_previa_casa" 
                                class="text-md font-semibold line-clamp-1">
                                    $ 9,999.00
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <!-- ESPACIO PARA PAGINADOR -->
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
