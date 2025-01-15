<!-- resources/views/profile/search-resultsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
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
        <!-- MUESTRA DE ROOMIES -->
        <div>
            <!-- MUESTRA DE ROOMIES -->
            <div class="mt-8 px-16 grid grid-cols-2 gap-6">
                @for ($i = 0; $i < 10; $i++)
                    <div class="flex flex-col py-3 px-3 rounded-lg">
                        <div class="h-44 w-full overflow-hidden rounded-md flex relative transition-transform transform hover:scale-105">
                            <a href="vista_previa_roomie" class="w-1/2">
                                <img class="object-cover w-full h-full border border-cianna-gray bg-white rounded-lg" 
                                src="{{ $defaultProfileImage }}" 
                                alt="Imagen previa del roomie" />
                            </a>
                            <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                                <a href="vista_previa_roomie" 
                                class="text-lg font-semibold line-clamp-1">
                                    NOMBRE APELLIDO
                                </a>
                                <a href="vista_previa_roomie" 
                                class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green font-semibold">
                                    CARRERA
                                </a>
                                <a href="" 
                                lass="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                                    XX años de edad
                                </a>
                                <a href="vista_previa_roomie" 
                                class="text-sm text-justify line-clamp-3 mt-1">
                                    DESCRIPCIÓN
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
