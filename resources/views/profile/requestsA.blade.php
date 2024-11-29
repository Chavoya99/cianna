<!-- resources/views/profile/requestsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title') {{ 'Postulaciones' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">Postulaciones recibidas</div>
        @if(count($postulaciones_pendientes) > 0)
            <div class="mt-2 ml-16">Postulaciones que has recibido y están pendientes</div>
        @endif
            <!-- Contenedor principal del carrusel -->
        <div class="relative overflow-hidden mt-2 ml-16 mr-16">
            @if (count($postulaciones_pendientes) == 0)
                <div class="w-full text-2xl mt-4">
                    <p class="mb-4 text-justify">
                        ¡Hola, {{Auth::user()->name}}!
                    </p>
                    <p class="mb-4 text-justify"><i class="fa-solid fa-circle-xmark mr-2"></i>
                        Parece que por ahora no has recibido ninguna postulación.
                    </p>
                    <p class="mb-4 text-justify">
                        ¡No te preocupes! Tarde o temprano llegará la persona adecuada para 
                        compartir el lugar que estás ofreciendo.                    
                    </p>
                    <p class="text-justify"><i class="fa-solid fa-magnifying-glass mr-2"></i>
                        Mientras tanto, continúa explorando los perfiles de los compañeros disponibles  
                        y agregalos a tus favoritos <i class="fa-solid fa-heart-circle-plus"></i>  
                        para que proximamente podamos ayudarte a decidir quién puede ser más compatible  
                        contigo dándote mejores recomendaciones.
                    </p>
                    
                </div>
            @endif
            @if(count($postulaciones_pendientes) > 4)
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
                @foreach ($postulaciones_pendientes as $postulacion)
                <div class="w-1/4 flex-shrink-0 flex flex-col mb-6 mt-5 px-5 transition-transform 
                    transform hover:scale-110">
                    <div class="mb-1">
                        <p class="font-bold">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            {{ ucfirst(\Carbon\Carbon::parse($postulacion->pivot->fecha)->diffForHumans()) }}
                        </p>
                    </div>
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md relative">
                            <a href="{{route('detalles_roomie', $postulacion)}}">
                                <img class="object-cover w-full h-full absolute top-0 left-0 
                                    border border-cianna-gray rounded-lg" 
                                    src="{{ asset('storage/'. $postulacion->user->archivos->first()->ruta_archivo) }}" 
                                    alt="Imagen previa del hogar" />
                            </a>
                        </div>
                    </div>
                    <!-- NOMBRE -->
                    <a href="{{route('detalles_roomie', $postulacion)}}" class="mt-2 text-lg 
                        font-semibold line-clamp-1">
                        {{$postulacion->user->name.' '.$postulacion->user->apellido}}
                    </a>
                    <!-- DESCRIPCIÓN -->
                    <a href="{{route('detalles_roomie', $postulacion)}}" class="text-sm text-justify 
                        line-clamp-3">
                        {{$postulacion->descripcion}}
                    </a>
                    <!-- CARRERA -->
                    <a href="{{route('detalles_roomie', $postulacion)}}" class="text-lg 
                        font-semibold line-clamp-1">
                        {{$carreras[$postulacion->carrera]}}
                    </a>
                    <div class="mt-2">
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
                            <div>
                                <form action="{{route('aceptar_postulacion', $postulacion)}}" method="POST">
                                    @csrf
                                    <button class="px-2 py-1 mt-2 border rounded bg-cianna-green
                                        text-white font-bold hover:bg-lime-600" type="submit">
                                        <i class="fa-solid fa-circle-check mr-1"></i>Aceptar
                                    </button>
                                </form>
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
            @if(count($postulaciones_pendientes) > 4)
                <!-- Botón de flecha derecha -->
                <button id="nextBtn" class="absolute right-0 top-[35%] transform -translate-y-1/2
                    bg-cianna-gray rounded-full p-2 z-10">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            @endif
        </div>
        <div class="flex justify-between ml-20">
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
                    Se han postulado y basado en tus favoritos creemos que podrían ser más compatibles contigo
                </div>
                <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="w-1/5 flex flex-col py-3 pl-3 pr-3 transition-transform 
                            transform hover:scale-110">
                                <div class="inline-block h-36 w-full overflow-hidden
                                    bg-cianna-gray border border-cianna-gray rounded-md relative">
                                    <a href="detalles_roomie">
                                        <img class="object-cover w-full h-full" 
                                            src="{{ $defaultProfileImage }}" 
                                            alt="Imagen previa del roomie" />
                                    </a>
                                </div>
                            <!-- NOMBRE ROOMIE -->
                            <a href="detalles_roomie" class="mt-2 text-lg font-semibold line-clamp-1">
                                Nombre
                            </a>
                            <!-- DESCRIPCIÓN ROOMIE -->
                            <a href="detalles_roomie" class="text-sm text-justify line-clamp-1">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Curabitur sed justo nec tortor laoreet porttitor et ut massa.
                            Nam eget orci vestibulum velit tristique gravida ut eget massa. 
                            Aenean ultrices in tellus vel dapibus. 
                            Nam elementum, dui a tempor viverra, mauris ante interdum eros, in vestibulum.
                            </a>
                        </div>
                    @endfor
                </div>
                <div class="text-right mr-20 mt-2">
                    <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                    href="listado_recomendacionesA">Ver más...</a>
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