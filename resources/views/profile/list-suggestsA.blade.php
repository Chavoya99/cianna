<!-- resources/views/profile/suggestsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
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
            Recomendado para ti
        </div>
        <div class="ml-16 mt-2">
            Se han postulado y basado en tus favoritos creemos que podrían ser más compatibles
            contigo
        </div>
        @if (isset($error_message))
            <div class="rounded-md bg-red-500 p-4 text-white">
                {{ $error_message }}
            </div>
        @endif
        <!-- MUESTRA DE POSTULACIONES-->
        <div class="mt-8 grid grid-cols-2 gap-6 px-16">
            <!-- Añadir clases de grid para 2 columnas y espacio entre elementos -->
            @foreach ($recomendaciones as $recomendacion)
                <!-- Bucle para crear 10 elementos (2 columnas x 5 filas) -->
                <div class="flex flex-col rounded-lg px-3 py-3">
                    <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                    <div
                        class="relative flex transform overflow-hidden rounded-md transition-transform hover:scale-105">
                        <!-- IMAGEN -->
                        <div class="h-52 w-52">
                            <a href="{{ route('detalles_roomie', $recomendacion) }}" class="w-1/2">
                                <img class="h-full w-full rounded-lg border border-cianna-gray bg-white object-cover"
                                    src="{{ asset('Storage/' . $recomendacion->user->archivos->first()->ruta_archivo) }}"
                                    alt="Imagen previa del roomie" />
                            </a>
                        </div>
                        <!-- ENLACES -->
                        <div class="flex w-1/2 flex-col justify-center px-3 py-3">
                            <!-- NOMBRE -->
                            <a href="ver_detalles_roomie"
                                class="line-clamp-1 text-lg font-semibold">
                                @if (Auth::user()->tipo == 'A')
                                    @if (in_array($recomendacion->user_id, $id_postulaciones))
                                        <i
                                            class="fa-solid fa-envelope mr-1 animate-bounce text-xs text-cianna-orange"></i>
                                    @endif
                                @elseif(Auth::user()->tipo == 'B')
                                    @if (in_array($recomendacion->user_id, $id_postulaciones_roomies))
                                        <i
                                            class="fa-solid fa-envelope-circle-check mr-1 animate-bounce text-xs text-cianna-orange"></i>
                                    @endif
                                @endif

                                {{ $recomendacion->user->name . ' ' . $recomendacion->user->apellido }}
                            </a>
                            <!-- CARRERA -->
                            <a href="ver_detalles_roomie"
                                class="mt-1 line-clamp-1 text-justify text-sm font-semibold text-cianna-green">
                                {{ $carreras[$recomendacion->carrera] }}
                            </a>
                            <!-- EDAD -->
                            <a href="ver_detalles_roomie"
                                class="mt-1 line-clamp-1 text-justify text-sm font-semibold text-gray-600">
                                {{ $recomendacion->edad }} años de edad
                            </a>
                            <!-- DESCRIPCIÓN -->
                            <a href="ver_detalles_roomie"
                                class="mt-1 line-clamp-3 text-justify text-sm">
                                {{ $recomendacion->descripcion }}
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
