<!-- resources/views/profile/list-pending-requestsB.blade.php -->
@props(['defaultRoomImage' => asset('img/img_prueba_casas/img_cuarto.jpg')])
@section('title') {{ 'Postulaciones | Pendientes' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl font-bold">Postulaciones pendientes</h1>
        </div>
        <div class="mt-2 ml-16">
            <p>Aquí están todas las postulaciones que has enviado y aún no han sido respondidas</p>
        </div>
        <!-- MUESTRA DE HOGARES -->
        <div class="mt-8 px-16 grid grid-cols-2 gap-6">
            @foreach($postulaciones_pendientes as $postulacion)
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="w-full overflow-hidden rounded-md flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="{{route('detalles_casa', $postulacion)}}" class="w-1/2">
                            <img class="object-cover w-full h-full border border-cianna-gray 
                                 rounded-lg" 
                                 src="{{ asset('storage/'. $postulacion->archivos->first()->ruta_archivo) }}" 
                                 alt="Imagen previa del hogar" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <!-- COLONIA -->
                            <a href="{{route('detalles_casa', $postulacion)}}" class="text-lg font-semibold line-clamp-1">
                                {{$postulacion->colonia}}
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="{{route('detalles_casa', $postulacion)}}" class="text-sm text-justify line-clamp-3">
                                {{$postulacion->descripcion}}
                            </a>
                            <!-- PRECIO -->
                            <a href="{{route('detalles_casa', $postulacion)}}" class="text-md font-semibold line-clamp-1">
                                $ {{number_format($postulacion->precio, 2, '.', ',')}}
                            </a>
                            <!-- ESTADO POSTULACIÓN -->
                            <div>
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
                                @elseif($estado_postulacion == "aceptada")
                                    <div class="flex">
                                        <p class="font-bold">Estado:</p>
                                        <p class="ml-1 text-cianna-green font-bold">Aceptada</p>
                                    </div>
                                    <div>
                                        <button class="px-2 py-1 mt-2 border rounded bg-cianna-blue 
                                            text-white font-bold hover:bg-sky-900" 
                                            onclick="">
                                            <i class="fa-solid fa-message mr-1"></i>Chat
                                        </button>
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