<!-- resources/views/profile/requestsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title')
    {{ 'Postulaciones' }}
@endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <div class="ml-16 mr-16 mt-8 text-3xl font-bold">Postulaciones recibidas</div>
        @if (count($postulaciones_pendientes) > 0)
            <div class="ml-16 mt-2">Postulaciones que has recibido y están pendientes</div>
        @endif
        <!-- Contenedor principal del carrusel -->
        <div class="relative ml-16 mr-16 mt-2 overflow-hidden">
            @if (count($postulaciones_pendientes) == 0)
                <div class="mt-4 w-full text-2xl">
                    <p class="mb-4 text-justify">
                        ¡Hola, {{ Auth::user()->name }}!
                    </p>
                    <p class="mb-4 text-justify"><i class="fa-solid fa-circle-xmark mr-2"></i>
                        Parece que por ahora no tienes ninguna postulacion pendiente por revisar.
                    </p>
                    <p class="mb-4 text-justify">
                        ¡No te preocupes! Tarde o temprano llegará la persona adecuada para
                        compartir el lugar que estás ofreciendo.
                    </p>
                    <p class="text-justify"><i class="fa-solid fa-magnifying-glass mr-2"></i>
                        Mientras tanto, continúa explorando los perfiles de los compañeros
                        disponibles
                        y agregalos a tus favoritos <i class="fa-solid fa-heart-circle-plus"></i>
                        para que proximamente podamos ayudarte a decidir quién puede ser más
                        compatible
                        contigo dándote mejores recomendaciones.
                    </p>

                </div>
            @endif
            @if (count($postulaciones_pendientes) > 4)
                <!-- Botón de flecha izquierda -->
                <button id="prevBtn"
                    class="absolute left-0 top-[35%] z-10 -translate-y-1/2 transform rounded-full bg-cianna-gray p-2">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            @endif
            <!-- Contenedor de imágenes del carrusel con ancho fijo para contener exactamente 4 imágenes -->
            <div class="flex w-full transition-transform duration-300" id="carousel-container"
                style="transform: translateX(0);">
                <!-- Imágenes del carrusel -->
                @foreach ($postulaciones_pendientes as $postulacion)
                    <div
                        class="mb-6 mt-5 flex w-1/4 flex-shrink-0 transform flex-col px-5 transition-transform hover:scale-110">
                        <div class="mb-1">
                            <p class="font-bold">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                {{ ucfirst(\Carbon\Carbon::parse($postulacion->pivot->fecha)->diffForHumans()) }}
                            </p>
                        </div>
                        <div class="block flex flex-col">
                            <div
                                class="relative inline-block h-44 w-full overflow-hidden rounded-md">
                                <a href="{{ route('detalles_roomie', $postulacion) }}">
                                    <img class="lazyload absolute left-0 top-0 h-full w-full rounded-lg border border-cianna-gray object-cover"
                                        data-src="{{ asset('storage/' . $postulacion->user->archivos->first()->ruta_archivo) }}"
                                        alt="Imagen previa del hogar" />
                                </a>
                            </div>
                        </div>
                        <!-- NOMBRE -->
                        <a href="{{ route('detalles_roomie', $postulacion) }}"
                            class="mt-2 line-clamp-1 text-lg font-semibold">
                            {{ $postulacion->user->name . ' ' . $postulacion->user->apellido }}
                        </a>
                        <!-- DESCRIPCIÓN -->
                        <a href="{{ route('detalles_roomie', $postulacion) }}"
                            class="line-clamp-3 text-justify text-sm">
                            {{ $postulacion->descripcion }}
                        </a>
                        <!-- CARRERA -->
                        <a href="{{ route('detalles_roomie', $postulacion) }}"
                            class="line-clamp-1 text-lg font-semibold">
                            {{ $carreras[$postulacion->carrera] }}
                        </a>
                        <!-- ESTADO POSTULACIÓN -->
                        <div class="mt-2">
                            <!-- FECHA DE POSTULACIÓN -->
                            <div class="flex">
                                <p class="mr-1 font-bold">Recibido: </p>
                                {{ ucfirst(\Carbon\Carbon::parse($postulacion->pivot->fecha)->translatedFormat('d [\de ]M [\de ] Y')) }}
                            </div>
                            @php
                                $estado_postulacion = $postulacion->pivot->estado;
                            @endphp
                            @if ($estado_postulacion == 'pendiente')
                                <div class="flex">
                                    <p class="font-bold">Estado:</p>
                                    <p class="ml-1 font-bold text-yellow-600">Pendiente</p>
                                </div>
                                <!-- BOTÓN ACEPTAR -->
                                <div>
                                    <form action="{{ route('aceptar_postulacion', $postulacion) }}"
                                        method="POST">
                                        @csrf
                                        <button
                                            class="mt-2 rounded border bg-cianna-green px-2 py-1 font-bold text-white hover:bg-lime-600"
                                            type="submit">
                                            <i class="fa-solid fa-circle-check mr-1"></i>Aceptar
                                        </button>
                                    </form>
                                </div>
                            @elseif($estado_postulacion == 'aceptada')
                                <div class="flex">
                                    <p class="font-bold">Estado:</p>
                                    <p class="ml-1 font-bold text-cianna-green">Aceptada</p>
                                </div>
                                <div>
                                    <button
                                        class="mt-2 rounded border bg-cianna-blue px-2 py-1 font-bold text-white hover:bg-sky-900"
                                        onclick="">
                                        <i class="fa-solid fa-message mr-1"></i>Chat
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            @if (count($postulaciones_pendientes) > 4)
                <!-- Botón de flecha derecha -->
                <button id="nextBtn"
                    class="absolute right-0 top-[35%] z-10 -translate-y-1/2 transform rounded-full bg-cianna-gray p-2">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            @endif
        </div>
        <div
            class="@if (count($postulaciones_pendientes) > 4) ml-20 
            @else ml-16 @endif flex justify-between">
            @if (count($postulaciones_pendientes) > 4)
                <div class="mr-20 mt-2 text-right">
                    <a class="font-semibold text-cianna-green hover:text-cianna-orange"
                        href="{{ route('lista_postulaciones_pendientes') }}">Ver más pendientes...
                    </a>
                </div>
            @endif
            @if ($total_postulaciones > 0)
                <div class="mr-20 mt-2 text-right">
                    <a class="font-semibold text-cianna-green hover:text-cianna-orange"
                        href="{{ route('lista_postulaciones') }}">Ver todo...
                    </a>
                </div>
            @endif
        </div>
        @if ($total_postulaciones > 0)
            <!-- RECOMENDACIONES -->
            <div class="w-full">
                <div class="ml-16 mr-16 mt-8 text-3xl font-bold text-cianna-orange">
                    Recomendado para ti
                </div>
                <div class="ml-16 mt-2">
                    Basado en tus favoritos creemos que podrían ser más compatibles contigo
                    <!-- Mostrar mensaje de error si existe -->
                    @if (isset($error_message))
                        <div class="rounded-md bg-red-500 p-4 text-white">
                            {{ $error_message }}
                        </div>
                    @endif
                    <!-- Verificar si hay favoritos -->
                    {{-- @if (isset($outcomes) && count($outcomes) > 0)
                        <h2 class="font-bold">Resultados</h2>
                        <ul>
                            @foreach ($outcomes as $outcome)
                                <li>ID usuario: {{ $outcome }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No hay favoritos disponibles. No podemos generar recomendaciones para ti en este momento.</p>
                    @endif --}}
                </div>
                <div class="ml-16 mr-16 mt-2 flex justify-between overflow-hidden">
                    @if (count($recomendaciones) > 0)
                        @foreach ($recomendaciones as $recomendacion)
                            <div
                                class="flex w-1/5 transform flex-col py-3 pl-3 pr-3 transition-transform hover:scale-110">
                                <div
                                    class="relative inline-block h-44 w-full overflow-hidden rounded-md border border-cianna-gray bg-cianna-gray">
                                    <a href="{{ route('detalles_roomie', $recomendacion) }}">
                                        <img class="lazyload h-full w-full object-cover"
                                            data-src="{{ asset('storage/' . $recomendacion->user->archivos->first()->ruta_archivo) }}"
                                            alt="Imagen previa del roomie" />
                                    </a>
                                </div>
                                <!-- NOMBRE ROOMIE -->
                                <a href="{{ route('detalles_roomie', $recomendacion) }}"
                                    class="mt-2 line-clamp-1 text-lg font-semibold">
                                    @if (in_array($recomendacion->user_id, $id_postulaciones))
                                        <i
                                            class="fa-solid fa-envelope mr-1 animate-bounce text-xs text-cianna-orange"></i>
                                    @endif
                                    {{ $recomendacion->user->name }}
                                </a>
                                <!-- DESCRIPCIÓN ROOMIE -->
                                <a href="{{ route('detalles_roomie', $recomendacion) }}"
                                    class="line-clamp-1 text-justify text-sm">
                                    {{ $recomendacion->descripcion }}
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>No hay favoritos disponibles. No podemos generar recomendaciones para ti
                            en este momento.</p>
                    @endif
                </div>
                <div class="mr-20 mt-2 text-right">
                    <a class="font-semibold text-cianna-green hover:text-cianna-orange"
                        @if (Auth::user()->tipo == 'A') href="{{ route('recomendaciones_a') }}">Ver más...</a>
                    @elseif(Auth::user()->tipo == 'B')
                        href="{{ route('recomendaciones_b') }}">Ver más...</a> @endif
                        </div>
                </div>
        @endif
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="@if (count($postulaciones_pendientes) == 0) mt-40 @else mt-4 @endif relative px-16">
            <button
                class="focus:shadow-outline rounded bg-cianna-blue px-4 py-2 font-bold text-white hover:bg-sky-900 focus:outline-none"
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carouselContainer = document.getElementById('carousel-container');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentIndex = 0;
        const itemsToShow = 4;
        const totalItems =
        {{ count($postulaciones_pendientes) }}; // Total de imágenes en el carrusel
        //totalItems se ajusta con el número de postulaciones del usuario

        // Función para actualizar la posición del carrusel
        function updateCarousel() {
            const offset = -(currentIndex * 100 / itemsToShow);
            carouselContainer.style.transform = `translateX(${offset}%)`;
        }

        // Evento click para el botón de siguiente
        nextBtn.addEventListener('click', function() {
            if (currentIndex < totalItems - itemsToShow) {
                currentIndex++;
                updateCarousel();
            }
        });

        // Evento click para el botón de anterior
        prevBtn.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });
    });
</script>
