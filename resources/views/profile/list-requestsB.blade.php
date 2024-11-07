<!-- resources/views/profile/list-requestsB.blade.php -->
@props(['defaultRoomImage' => asset('img/img_prueba_casas/img_cuarto.jpg')])
@section('title') {{ 'Postulaciones | Todo' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl font-bold">Postulaciones enviadas</h1>
        </div>
        <div class="mt-2 ml-16">Aquí están todas las postulaciones que has enviado</div>
        <!-- MUESTRA DE HOGARES -->
        <div class="mt-8 px-16 grid grid-cols-2 gap-6">
            <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
            @foreach ($postulaciones as $postulacion )
                
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="{{route('detalles_casa', $postulacion)}}" class="w-1/2">
                            <img class="object-cover w-full h-full border border-cianna-gray 
                                 rounded-lg" 
                                 src="{{ asset('storage/'. $postulacion->archivos->first()->ruta_archivo)}}" 
                                 alt="Imagen previa del hogar" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <!-- COLONIA -->
                            <a href="{{route('detalles_casa', $postulacion)}}" class="text-lg font-semibold line-clamp-1">
                                {{$postulacion->colonia}}
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="{{route('detalles_casa', $postulacion)}}"class="text-sm text-justify line-clamp-3">
                                {{$postulacion->descripcion}}
                            </a>
                            <!-- PRECIO -->
                            <a href="{{route('detalles_casa', $postulacion)}}" class="text-md font-semibold line-clamp-1">
                                $ {{number_format($postulacion->precio, 2, '.', ',')}}
                            </a>
                            <p>Fecha: {{date_format($postulacion->pivot->fecha, 'd-m-Y')}}</p>
                            <p>Estado: {{$postulacion->pivot->estado}}</p>
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