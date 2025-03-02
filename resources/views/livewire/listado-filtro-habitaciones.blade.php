<!-- MUESTRA DE HABITACIONES -->
<div>
    <!-- MUESTRA DE HOGARES -->
    <div class="mt-8 grid grid-cols-2 gap-6 px-16">
        <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
        @foreach ($casas as $casa)
            <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
            <div class="flex flex-col rounded-lg px-3 py-3">
                <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                <div
                    class="relative flex h-44 w-full transform overflow-hidden rounded-md transition-transform hover:scale-105">
                    <!-- IMAGEN -->
                    <a href="{{ route('detalles_casa', $casa) }}" class="w-1/2">
                        <img class="lazyload h-full w-full rounded-lg border border-cianna-gray object-cover"
                            data-src="{{ asset('Storage/' . $casa->archivos->first()->ruta_archivo) }}"
                            alt="Imagen previa del hogar" />
                    </a>
                    <!-- ENLACES -->
                    <div class="flex w-1/2 flex-col justify-center px-3 py-3">
                        <!-- COLONIA -->
                        <a href="{{ route('detalles_casa', $casa) }}"
                            class="line-clamp-1 text-lg font-semibold">
                            {{ $casa->colonia }}
                        </a>
                        <!-- DESCRIPCIÓN -->
                        <a href="{{ route('detalles_casa', $casa) }}"
                            class="line-clamp-3 text-justify text-sm">
                            {{ $casa->descripcion }}
                        </a>
                        <!-- PRECIO -->
                        <a href="{{ route('detalles_casa', $casa) }}"
                            class="text-md line-clamp-1 font-semibold">
                            $ {{ number_format($casa->precio, 2, '.', ',') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Paginación -->
    @if ($casas->hasPages())
        <div class="mt-8 px-20">
            {{ $casas->links() }}
        </div>
    @endif
</div>
