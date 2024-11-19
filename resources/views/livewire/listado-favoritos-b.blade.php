<!-- resources/livewire/listado-favoritos-b.blade.php -->

<!-- Aquí solo pasamos la vista del for y el paginador -->
<div>
    <!-- MUESTRA DE FAVORITOS -->
    <div class="mt-8 px-16 @if(count($favoritos) == 0) grid grid-cols-1 
        @else grid grid-cols-2 gap-6 @endif"> <!-- Grid de 1 columna si no hay favoritos, 2 columnas y espacio de 6 si los hay -->
        @if(count($favoritos) == 0)
            <div class="w-full text-2xl">
                <p class="mb-4 text-justify">
                    ¡Hola, {{Auth::user()->name}}!
                </p>
                <p class="mb-4 text-justify"><i class="fa-solid fa-heart-circle-xmark mr-2"></i>
                    Parece que por ahora no has añadido ninguna habitación a tus favoritos.
                </p>
                <p class="mb-4 text-justify">
                    ¡No te preocupes! Tarde o temprano encontrarás el lugar más adecuado para 
                    tus necesidades actuales.                    
                </p>
                <p class="text-justify"><i class="fa-solid fa-magnifying-glass mr-2"></i>
                    Continúa explorando las habitaciones disponibles y agrega a tus favoritos 
                    <i class="fa-solid fa-heart-circle-plus"></i> para que podamos ayudarte
                    a encontrar lo que necesitas dándote mejores recomendaciones.
                </p>
            </div>
        @else
            @foreach ($favoritos as $favorito) 
                <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                <div class="flex flex-col py-3 px-3 rounded-lg">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                        transition-transform transform hover:scale-105">
                        <!-- IMAGEN -->
                        <a href="{{route('detalles_casa', $favorito)}}" class="w-1/2">
                            <img class="object-cover w-full h-full border border-cianna-gray 
                                bg-white rounded-lg" src="{{ asset('storage/'.$favorito->archivos->first()->ruta_archivo) }}" 
                                alt="Imagen previa de la habitación" />
                        </a>
                        <!-- ENLACES -->
                        <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                            <p class="absolute right-0 top-0 text-cianna-orange">
                                <i class="fa-solid fa-heart mt-1 mr-2"></i>
                                Favoritos
                            </p>
                            <!-- NOMBRE -->
                            <a href="{{route('detalles_casa', $favorito)}}" class="text-lg font-semibold line-clamp-1">
                                {{$favorito->colonia}}
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="{{route('detalles_casa', $favorito)}}" class="text-sm text-justify line-clamp-3">
                                {{$favorito->descripcion}}
                            </a>
                            <!-- PRECIO -->
                            <a href="{{route('detalles_casa', $favorito)}}" class="text-md font-semibold mt-2">
                                $ {{number_format($favorito->precio, 2, '.', ',')}}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <br>
            {{--<div class="text-right mt-2">
                <a class="text-cianna-green font-semibold hover:text-cianna-orange absolute right-0 px-20" 
                    href="listado_favsB">Ver más...
                </a>
            </div>--}}
        @endif
    </div>
    <!-- Paginación -->
    @if($favoritos->hasPages())
        <div class="mt-8 px-20">
            {{ $favoritos->links() }}
        </div>
    @endif
    <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
    <div class="relative px-16 @if(count($favoritos) == 0) mt-40 @else mt-4 @endif">
        <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
            rounded focus:outline-none focus:shadow-outline" 
            onclick="window.history.back()">
            <i class="fa-solid fa-left-long mr-2"></i>Regresar
        </button>
    </div>
</div>
