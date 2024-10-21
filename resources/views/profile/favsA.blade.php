<!-- resources/views/profile/favsA.blade.php -->
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
        <!-- MUESTRA DE ROOMIES -->
        <div class="mt-8 px-16 @if(count($favoritos) == 0) grid grid-cols-1 
            @else grid grid-cols-2 gap-6 @endif"> <!-- Grid de 1 columna si no hay favoritos, 2 columnas y espacio de 6 si los hay -->
            @if(count($favoritos) == 0)
                <div class="w-full text-2xl">
                    <p class="mb-4 text-justify">
                        ¡Hola, {{Auth::user()->name}}!
                    </p>
                    <p class="mb-4 text-justify"><i class="fa-solid fa-heart-circle-xmark mr-2"></i>
                        Parece que por ahora no has añadido ninguna persona a tus favoritos.
                    </p>
                    <p class="mb-4 text-justify">
                        ¡No te preocupes! Tarde o temprano encontrarás a la persona adecuada para
                        compartir el lugar que estás ofreciendo.
                    </p>
                    <p class="text-justify"><i class="fa-solid fa-magnifying-glass mr-2"></i>
                        Continúa explorando los perfiles de los compañeros disponibles y agrega a 
                        tus favoritos <i class="fa-solid fa-heart-circle-plus"></i> para que podamos 
                        ayudarte a decidir quién puede ser más compatible contigo dándote mejores 
                        recomendaciones.
                    </p>
                </div>
            @else
                @foreach($favoritos as $favorito) <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                    <div class="flex flex-col py-3 px-3 rounded-lg">
                        <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                        <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                            transition-transform transform hover:scale-105">
                            <!-- IMAGEN -->
                            <a href="{{route('detalles_roomie', $favorito)}}" class="w-1/2">
                                <img class="object-cover w-full h-full border border-cianna-gray 
                                    bg-white rounded-lg" src="{{ asset('storage/'.$favorito->user->archivos->first()->ruta_archivo) }}" 
                                    alt="Imagen previa del roomie" />
                            </a>
                            <!-- ENLACES -->
                            <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                                <p class="absolute right-0 top-0 text-cianna-orange">
                                    <i class="fa-solid fa-heart mt-1 mr-2"></i>
                                    Favoritos
                                </p>
                                <!-- NOMBRE -->
                                <a href="{{route('detalles_roomie', $favorito)}}" class="text-lg font-semibold line-clamp-1">
                                    {{$favorito->user->name.' '.$favorito->user->apellido}}
                                </a>
                                <!-- CARRERA -->
                                <a href="{{route('detalles_roomie', $favorito)}}" class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green font-semibold">
                                    {{$carreras[$favorito->carrera]}}
                                </a>
                                <!-- EDAD -->
                                <a href="{{route('detalles_roomie', $favorito)}}" class="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                                    {{$favorito->edad}} años de edad
                                </a>
                                <!-- DESCRIPCIÓN -->
                                <a href="{{route('detalles_roomie', $favorito)}}" class="text-sm text-justify line-clamp-3 mt-1">
                                    {{$favorito->descripcion}}
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
            @endif
        </div>
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative px-16 mt-40">
            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                rounded focus:outline-none focus:shadow-outline" 
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>
