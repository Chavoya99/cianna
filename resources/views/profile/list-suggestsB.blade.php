<!-- resources/views/profile/list-suggestsB.blade.php -->
@props(['defaultRoomImage' => asset('img/img_prueba_casas/img_cuarto.jpg')])
@section('title')
    {{ 'Recomendaciones' }}
@endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="ml-16 mr-16 mt-8 text-3xl font-bold text-cianna-orange">
            <h1 class="text-3xl text-cianna-orange">Recomendado para ti</h1>
        </div>
        <div class="ml-16 mt-2">
            <p>Te has postulado y con base en en tus intereses creemos que podrían ser más
                compatibles contigo</p>
        </div>
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
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative mt-4 px-20">
            <button
                class="focus:shadow-outline rounded bg-cianna-blue px-4 py-2 font-bold text-white hover:bg-sky-900 focus:outline-none"
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>
