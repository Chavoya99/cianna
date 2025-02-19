<!-- resources/views/profile/requestsB.blade.php -->
@props(['defaultRoomImage' => asset('img/img_prueba_casas/img_cuarto.jpg')])
@section('title') {{ 'Postulaciones' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">Postulaciones enviadas</div>
        @if(count($postulaciones_pendientes) > 0)
            <div class="mt-2 ml-16">Postulaciones que has enviado y están pendientes</div>
        @endif
        <!-- Contenedor principal del carrusel -->
        <div class="relative overflow-hidden mt-2 ml-16 mr-16">
            @if (count($postulaciones_pendientes) == 0)
                <div class="w-full text-2xl mt-4">
                    <p class="mb-4 text-justify">
                        ¡Hola, {{Auth::user()->name}}!
                    </p>
                    <p class="mb-4 text-justify"><i class="fa-solid fa-circle-xmark mr-2"></i>
                        Parece que por ahora no has enviado ninguna postulación.
                    </p>
                    <p class="mb-4 text-justify">
                        ¡No te preocupes! Tarde o temprano encontrarás el lugar más adecuado para 
                        tus necesidades actuales.                    
                    </p>
                    <p class="text-justify"><i class="fa-solid fa-magnifying-glass mr-2"></i>
                        Continúa explorando las habitaciones disponibles y agrega a tus favoritos 
                        <i class="fa-solid fa-heart-circle-plus"></i> para que podamos ayudarte
                        dándote mejores recomendaciones y finalmente puedas postularte a alguna.
                    </p>
                </div>
            @endif
            @if (count($postulaciones_pendientes) > 4)
                <!-- Botón de flecha izquierda -->
                <button id="prevBtn" class="absolute left-0 top-[35%] transform -translate-y-1/2 
                    bg-cianna-gray rounded-full p-2 z-10">
                    <i class="fa-solid fa-chevron-left"></i>
                </button> 
            @endif
            <!-- Contenedor de imágenes del carrusel con ancho fijo para contener exactamente 4 imágenes -->
            <div class="flex transition-transform duration-300 w-full" id="carousel-container" 
                style="transform: translateX(0);">
                <!-- Imágenes del carrusel -->
                @foreach($postulaciones_pendientes as $postulacion)
                <div class="w-1/4 flex-shrink-0 flex flex-col mb-6 mt-5 px-5 transition-transform 
                    transform hover:scale-110">
                    <div class="mb-1">
                        <p class="font-bold">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            {{ ucfirst(\Carbon\Carbon::parse($postulacion->pivot->fecha)->diffForHumans()) }}
                        </p>
                    </div>
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md 
                            bg-gray-100 relative">
                            <a href="{{route('detalles_casa', $postulacion)}}">
                                <img class="object-cover w-full h-full absolute top-0 left-0 
                                    border border-cianna-gray rounded-lg" 
                                    src="{{ asset('storage/'. $postulacion->archivos->first()->ruta_archivo) }}" 
                                    alt="Imagen previa del hogar" />
                            </a>
                        </div>
                    </div>
                    <!-- COLONIA -->
                    <a href="{{route('detalles_casa', $postulacion)}}" 
                        class="mt-2 text-lg font-semibold line-clamp-1">
                        {{$postulacion->colonia}}
                    </a>
                    <!-- DESCRIPCIÓN -->
                    <a href="{{route('detalles_casa', $postulacion)}}" 
                        class="text-sm text-justify line-clamp-3">
                    {{$postulacion->descripcion}}
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
                @endforeach
            </div>
            @if (count($postulaciones_pendientes) > 4)
                <!-- Botón de flecha derecha -->
                <button id="nextBtn" class="absolute right-0 top-[35%] transform -translate-y-1/2 
                    bg-cianna-gray rounded-full p-2 z-10">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            @endif
        </div>
        <div class="flex justify-between @if (count($postulaciones_pendientes) > 4) ml-20 
            @else ml-16 @endif">
            @if (count($postulaciones_pendientes) > 4)
            <div class="text-right mr-20 mt-2">
                <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                    href="{{route('lista_postulaciones_pendientes')}}">Ver más pendientes...
                </a>
            </div>
            @endif
            @if ($total_postulaciones > 0)
                <div class="text-right mr-20 mt-2">
                    <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                        href="{{route('lista_postulaciones')}}">Ver todo...
                    </a>
                </div>
            @endif
        </div>
        
        @if($total_postulaciones > 0)
            <!-- RECOMENDACIONES -->
            <div class="w-full">
                <div class="font-bold text-3xl mt-8 ml-16 mr-16 text-cianna-orange">
                    Recomendado para ti
                </div>
                <div class="mt-2 ml-16">
                    Basado en en tus intereses creemos que podrían ser más compatibles contigo
                    <!-- Mostrar mensaje de error si existe -->
                    @if(isset($error_message))
                        <div class="bg-red-500 text-white p-4 rounded-md">
                            {{ $error_message }}
                        </div>
                    @endif
                    <!-- Verificar si hay favoritos -->
                    @if(isset($outcomes) && count($outcomes) > 0)
                        <h2>Resultados</h2>
                        <ul>
                            @foreach($outcomes as $outcome)
                                <li>ID casa: {{ $outcome }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No hay favoritos disponibles. No podemos generar recomendaciones para ti en este momento.</p>
                    @endif
                </div>
                <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="w-1/5 flex flex-col mb-3 mt-5 px-5 transition-transform 
                            transform hover:scale-110">
                            <div class="flex flex-col block">
                                <div class="inline-block h-36 w-full overflow-hidden rounded-md 
                                    bg-gray-100 relative">
                                    <a href="ver_detalles_habitacion">
                                        <img class="object-cover w-full h-full absolute top-0 
                                        left-0 border border-cianna-gray rounded-lg" 
                                            src="{{ $defaultRoomImage }}" 
                                            alt="Imagen previa roomie" />
                                    </a>
                                </div>
                            </div>
                            <!-- COLONIA -->
                            <a href="ver_detalles_habitacion" 
                                class="mt-2 text-lg font-semibold line-clamp-1">
                                Colonia
                            </a>
                            <!-- DESCRIPCIÓN ROOMIE -->
                            <a href="ver_detalles_habitacion" 
                                class="text-sm text-justify line-clamp-1">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Curabitur sed justo nec tortor laoreet porttitor et ut massa.
                                Nam eget orci vestibulum velit tristique gravida ut eget massa. 
                                Aenean ultrices in tellus vel dapibus. 
                                Nam elementum, dui a tempor viverra, mauris ante interdum eros, in vestibulum.
                            </a>
                            <!-- PRECIO  -->
                            <a href="ver_detalles_habitacion" class="mt-2 font-semibold">
                                $9,999.00
                            </a>
                        </div>
                    @endfor
                </div>
                <div class="text-right mr-20 mt-2">
                    <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                        href="listado_recomendacionesB">
                        Ver más...
                    </a>
                </div>
            </div>
        @endif
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative px-16 @if(count($postulaciones_pendientes) == 0) mt-40 @else mt-4 @endif">
            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                rounded focus:outline-none focus:shadow-outline" 
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
        const totalItems = {{count($postulaciones_pendientes)}}; // Total de imágenes en el carrusel

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