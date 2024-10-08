<!-- resources/views/profile/requestsB.blade.php -->
@props(['defaultRoomImage' => asset('img/img_prueba_casas/img_cuarto.jpg')])
@section('title') {{ 'Postulaciones enviadas' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">Postulaciones enviadas</div>
        <div class="mt-2 ml-16">Todas las postulaciones que has enviado</div>
        <!-- Contenedor principal del carrusel -->
        <div class="relative overflow-hidden mt-2 ml-16 mr-16">
            <!-- Botón de flecha izquierda -->
            <button id="prevBtn" class="absolute left-0 top-[35%] transform -translate-y-1/2 bg-cianna-gray rounded-full p-2 z-10">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <!-- Contenedor de imágenes del carrusel con ancho fijo para contener exactamente 4 imágenes -->
            <div class="flex transition-transform duration-300 w-full" id="carousel-container" style="transform: translateX(0);">
                <!-- Imágenes del carrusel -->
                @for ($i = 0; $i < 8; $i++)
                <div class="w-1/4 flex-shrink-0 flex flex-col mb-3 mt-5 px-5 transition-transform transform hover:scale-110">
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                            <a href="ver_detalles_habitacion">
                                <img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                                    src="{{ $defaultRoomImage }}" 
                                    alt="Imagen previa del hogar" />
                            </a>
                        </div>
                    </div>
                    <!-- COLONIA -->
                    <a href="ver_detalles_habitacion" class="mt-2 text-lg font-semibold line-clamp-1">Colonia</a>
                    <!-- DESCRIPCIÓN -->
                    <a href="ver_detalles_habitacion" class="text-sm text-justify line-clamp-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Curabitur sed justo nec tortor laoreet porttitor et ut massa.
                    Nam eget orci vestibulum velit tristique gravida ut eget massa. 
                    Aenean ultrices in tellus vel dapibus. 
                    Nam elementum, dui a tempor viverra, mauris ante interdum eros, in vestibulum.
                    </a>
                    <!-- PRECIO  -->
                    <a href="ver_detalles_habitacion" class="mt-2 font-semibold">$9,999.00</a>
                </div>
                @endfor
            </div>
            <!-- Botón de flecha derecha -->
            <button id="nextBtn" class="absolute right-0 top-[35%] transform -translate-y-1/2 bg-cianna-gray rounded-full p-2 z-10">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
        <div class="text-right mr-20 mt-2">
            <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                href="listado_requestsB">Ver más...
            </a>
        </div>
        <!-- RECOMENDACIONES -->
        <div class="w-full">
            <div class="font-bold text-3xl mt-8 ml-16 mr-16 text-cianna-orange">Recomendado para ti</div>
            <div class="mt-2 ml-16">Te has postulado y basado en tus intereses creemos que podrían ser mejor para ti</div>
            <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
                @for ($i = 0; $i < 5; $i++)
                    <div class="w-1/5 flex flex-col mb-3 mt-5 px-5 transition-transform transform hover:scale-110">
                        <div class="flex flex-col block">
                            <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                                <a href="ver_detalles_habitacion">
                                    <img class="object-cover w-full h-full absolute top-0 
                                    left-0 border border-cianna-gray rounded-lg" 
                                        src="{{ $defaultRoomImage }}" 
                                        alt="Imagen previa roomie" />
                                </a>
                            </div>
                        </div>
                        <!-- COLONIA -->
                        <a href="ver_detalles_habitacion" class="mt-2 text-lg font-semibold line-clamp-1">Colonia</a>
                        <!-- DESCRIPCIÓN ROOMIE -->
                        <a href="ver_detalles_habitacion" class="text-sm text-justify line-clamp-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Curabitur sed justo nec tortor laoreet porttitor et ut massa.
                        Nam eget orci vestibulum velit tristique gravida ut eget massa. 
                        Aenean ultrices in tellus vel dapibus. 
                        Nam elementum, dui a tempor viverra, mauris ante interdum eros, in vestibulum.
                        </a>
                        <!-- PRECIO  -->
                        <a href="ver_detalles_habitacion" class="mt-2 font-semibold">$9,999.00</a>
                    </div>
                @endfor
            </div>
            <div class="text-right mr-20 mt-2">
                <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                href="listado_suggestsB">Ver más...</a>
            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const carouselContainer = document.getElementById('carousel-container');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;
    const itemsToShow = 4;
    const totalItems = 8; // Total de imágenes en el carrusel

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