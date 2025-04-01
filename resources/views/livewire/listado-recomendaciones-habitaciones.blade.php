<div>
    <!-- MUESTRA DE HOGARES -->
    <div class="mt-8 grid grid-cols-2 gap-6 px-16">
        <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
        @foreach ($casas as $casa)
            <div class="flex flex-col rounded-lg px-3 py-3">
                <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                <div
                    class="relative flex transform overflow-hidden rounded-md transition-transform hover:scale-105">
                    <!-- IMAGEN -->
                    <div class="h-44 w-80">
                        <a href="{{ route('detalles_casa', $casa) }}" class="w-1/2">
                            <img class="h-full w-full rounded-lg border border-cianna-gray object-fill"
                                src="{{ asset('storage/' . $casa->archivos->first()->ruta_archivo) }}"
                                alt="Imagen previa del hogar" />
                        </a>
                    </div>
                    <!-- ENLACES -->
                    <div class="flex w-1/2 flex-col justify-center px-3 py-3">
                        <!-- COLONIA -->
                        <a href="{{ route('detalles_casa', $casa) }}"
                            class="line-clamp-1 text-lg font-semibold">
                            @if (in_array($casa->id, $id_postulaciones_casas))
                                <i
                                    class="fa-solid fa-envelope-circle-check mr-1 animate-bounce text-xs text-cianna-orange"></i>
                            @endif
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
    @if (isset($casas) && method_exists($casas, 'hasPages') && $casas->hasPages())
        <div class="mt-8 px-20">
            {{ $casas->links() }}
        </div>
    @endif
</div>
