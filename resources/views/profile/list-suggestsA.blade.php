<!-- resources/views/profile/suggestsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title') {{ 'Postulaciones | Recomendaciones' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="font-bold text-3xl mt-8 ml-16 mr-16 text-cianna-orange">
            Recomendado para ti
        </div>
        <div class="mt-2 ml-16">
            Se han postulado y basado en tus favoritos creemos que podrían ser más compatibles contigo
        </div>
        @if(isset($error_message))
            <div class="bg-red-500 text-white p-4 rounded-md">
                {{ $error_message }}
            </div>
        @endif
        <!-- MUESTRA DE POSTULACIONES-->
        <div class="mt-8 px-16 grid grid-cols-2 gap-6"> <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
            @foreach ($recomendaciones as $recomendacion) <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="{{route('detalles_roomie', $recomendacion)}}" class="w-1/2">
                            <img class="object-cover w-full h-full border border-cianna-gray 
                                bg-white rounded-lg" src="{{asset('Storage/'.$recomendacion->user->archivos->first()->ruta_archivo)}}" 
                                alt="Imagen previa del roomie" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <!-- NOMBRE -->
                            <a href="ver_detalles_roomie" class="text-lg font-semibold line-clamp-1">
                                @if (Auth::user()->tipo == 'A')
                                    @if (in_array($recomendacion->user_id, $id_postulaciones))
                                        *
                                    @endif
                                @elseif(Auth::user()->tipo == 'B')
                                    @if (in_array($recomendacion->user_id, $id_postulaciones_roomies))
                                        *
                                    @endif
                                @endif
                                
                                {{$recomendacion->user->name." ".$recomendacion->user->apellido}}
                            </a>
                            <!-- CARRERA -->
                            <a href="ver_detalles_roomie" class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green font-semibold">
                                {{$carreras[$recomendacion->carrera]}}
                            </a>
                            <!-- EDAD -->
                            <a href="ver_detalles_roomie" class="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                                {{$recomendacion->edad}} años de edad
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="ver_detalles_roomie" class="text-sm text-justify line-clamp-3 mt-1">
                                {{$recomendacion->descripcion}}
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