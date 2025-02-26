<!-- resources/views/profile/list-suggestsB.blade.php -->
@props(['defaultRoomImage' => asset('img/img_prueba_casas/img_cuarto.jpg')])
@section('title') {{ 'Postulaciones | Recomendaciones' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="font-bold text-3xl mt-8 ml-16 mr-16 text-cianna-orange">
            <h1 class="text-cianna-orange text-3xl">Recomendado para ti</h1>
        </div>
        <div class="mt-2 ml-16">
            <p>Te has postulado y con base en en tus intereses creemos que podrían ser más compatibles contigo</p>
        </div>
        <!-- MUESTRA DE HOGARES -->
        <div class="mt-8 px-16 grid grid-cols-2 gap-6">
            <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->

            @foreach ($casas as $casa)
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="{{route('detalles_casa', $casa)}}" class="w-1/2">
                            <img class="object-cover w-full h-full border border-cianna-gray 
                                 rounded-lg" 
                                 src="{{ asset('storage/'. $casa->archivos->first()->ruta_archivo) }}" 
                                 alt="Imagen previa del hogar" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <!-- COLONIA -->
                            <a href="{{route('detalles_casa', $casa)}}" class="text-lg font-semibold line-clamp-1">
                                @if (in_array($casa->id, $id_postulaciones_casas))
                                    *
                                @endif
                                {{$casa->colonia}}
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="{{route('detalles_casa', $casa)}}" class="text-sm text-justify line-clamp-3">
                                {{$casa->descripcion}}
                            </a>
                            <!-- PRECIO -->
                            <a href="{{route('detalles_casa', $casa)}}" class="text-md font-semibold line-clamp-1">
                                $ {{number_format($casa->precio, 2, '.', ',')}}
                            </a>
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