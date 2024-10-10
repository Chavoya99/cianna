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
        <div class="mt-8 px-16 grid grid-cols-2 gap-6"> <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
            @if(count($favoritos) == 0)
                No tienes favoritos agregados
            @else
                @foreach($favoritos as $favorito) <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                    <div class="flex flex-col py-3 px-3 rounded-lg">
                        <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                        <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                            transition-transform transform hover:scale-105">
                            <!-- IMAGEN -->
                            <a href="{{route('detalles_roomie', $favorito)}}" class="w-1/2">
                                <img class="object-contain w-full h-full border border-cianna-gray 
                                    bg-white rounded-lg" src="{{ asset('storage/'.$favorito->user->archivos->first()->ruta_archivo) }}" 
                                    alt="Imagen previa del roomie" />
                            </a>
                            <!-- ENLACES -->
                            <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                                <p class="absolute right-0 top-0 text-cianna-orange">
                                    <i class="fa-solid fa-star mt-1 mr-2"></i>
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
                <div class="text-right mt-2">
                    <a class="text-cianna-green font-semibold hover:text-cianna-orange absolute right-0 px-20" 
                        href="listado_favsA">Ver más...
                    </a>
                </div>
            @endif
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
