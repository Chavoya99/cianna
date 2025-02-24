<div>
    <!-- MUESTRA DE HOGARES -->
    <div class="mt-8 px-16 grid grid-cols-2 gap-6"> <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
        @foreach ($casas as $casa) <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
            <div class="flex flex-col py-3 px-3 rounded-lg">
                <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                <div class="h-44 w-full overflow-hidden rounded-md flex relative 
                    transition-transform transform hover:scale-105">
                    <!-- IMAGEN -->
                    <a href="{{route('vista_previa_casa', $casa)}}" class="w-1/2">
                        <img class="object-cover w-full h-full border border-cianna-gray rounded-lg lazyload"
                             data-src="{{asset('storage/'.$casa->archivos->first()->ruta_archivo)}}" 
                             alt="Imagen previa del hogar" />
                    </a>
                    <!-- ENLACES -->
                    <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                        <!-- COLONIA -->
                        <a href="{{route('vista_previa_casa', $casa)}}" class="text-lg font-semibold line-clamp-1">
                            {{$casa->colonia}}
                        </a>
                        <!-- DESCRIPCIÓN -->
                        <a href="{{route('vista_previa_casa', $casa)}}" class="text-sm text-justify line-clamp-3">
                            {{$casa->descripcion}}
                        </a>
                        <!-- PRECIO -->
                        <a href="{{route('vista_previa_casa', $casa)}}" class="text-md font-semibold line-clamp-1">
                            $ {{number_format($casa->precio, 2, '.', ',')}}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    @if($casas->hasPages())
        <div class="mt-8 px-20">
            {{ $casas->links() }}
        </div>
    @endif
</div>
