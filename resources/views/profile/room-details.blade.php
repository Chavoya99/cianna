<!-- resources/views/profile/room-details.blade.php -->
@section('title') {{ 'Detalles del hogar' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Detalle de hogar</h1>
        </div>
        <!-- DETALLES -->
        <div class="flex w-full mt-8">
            <!-- CONTENEDOR IZQUIERDO -->
            <div class="relative w-1/2 pl-16 pr-4 overflow-hidden">
                <div id="carousel" class="transition-transform duration-500">
                    @foreach (array_chunk($img_casa, 3) as $chunkIndex => $chunk) 
                    <div class="flex flex-col items-center mt-3 carousel-item" 
                        data-index="{{ $chunkIndex }}">
                        <div class="flex flex-col items-center block w-full">
                            <div class="inline-block relative h-64 w-full overflow-hidden 
                            rounded-md bg-gray-100">
                                <img class="w-full h-full object-fill border-2 border-cianna-gray 
                                rounded-lg" src="{{ asset('storage/' . $chunk[0]['ruta_archivo']) }}" 
                                alt="Imagen previa" />
                            </div>
                        </div>
                        <!-- IMAGEN 2 Y 3 -->
                        <div class="flex flex-row items-center mt-2">
                            <div class="inline-block relative h-64 w-1/2 overflow-hidden rounded-md 
                                bg-gray-100 mr-1">
                                <img class="w-full h-full object-fill border-2 border-cianna-gray 
                                rounded-lg" 
                                src="{{ asset('storage/' . $chunk[1]['ruta_archivo']) }}" 
                                alt="Imagen previa" />
                            </div>
                            @if(count($chunk) == 3)
                                <div class="inline-block relative h-64 w-1/2 overflow-hidden rounded-md 
                                    bg-gray-100 ml-1">
                                    <img class="w-full h-full object-fill border-2 border-cianna-gray 
                                    rounded-lg" 
                                    src="{{ asset('storage/' . $chunk[2]['ruta_archivo']) }}" 
                                    alt="Imagen previa" />
                                </div>
                            @endif
                            
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- BOTONES DE NAVEGACIÓN -->
                <div class="flex justify-center mt-4">
                    <button class="bg-cianna-orange hover:bg-orange-300 text-white font-bold py-2 px-4 
                        mr-1 rounded focus:outline-none focus:shadow-outline" id="prevButton">
                        <i class="fa-solid fa-chevron-left px-2"></i>
                    </button>
                    <button class="bg-cianna-orange hover:bg-orange-300 text-white font-bold py-2 px-4 
                        rounded focus:outline-none focus:shadow-outline" id="nextButton">
                        <i class="fa-solid fa-chevron-right px-2"></i>
                    </button>
                </div>
                <button class="bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 mt-40 px-4
                        rounded focus:outline-none focus:shadow-outline" 
                        onclick="window.history.back()">
                        <i class="fa-solid fa-left-long mr-2"></i>Regresar
                </button>
            </div>
            <!-- CONTENEDOR DERECHO -->
            <div class="w-1/2 px-8">
                <div class="py-3">
                    <x-custom-label class=" flex text-lg px-2">Domicilio</x-custom-label>
                    <div class="flex flex-wrap">
                        <div class="w-4/6 px-2">
                            <x-custom-label>Calle</x-custom-label>
                            <div class="bg-white rounded-md text-center py-1 border 
                                border-cianna-gray">
                                <p>{{$casa->calle}}</p>
                            </div>
                        </div>
                        <div class="w-1/6 px-2">
                            <x-custom-label>N° ext.</x-custom-label>
                            <div class="bg-white rounded-md text-center py-1 border 
                                border-cianna-gray">
                                <p>{{$casa->num_ext}}</p>
                            </div>
                        </div>
                        <div class="w-1/6 px-2">
                            <x-custom-label>N° int.</x-custom-label>
                            <div class="bg-white rounded-md text-center py-1 border 
                                border-cianna-gray">
                                <p>@if(!$casa->num_int) N/A @else $casa->num_int @endif</p>
                        </div>
                        </div>
                    </div>
                    <!-- CP, ciudad y colonia -->
                    <div class="flex flex-wrap mt-4">
                        <div class="w-1/5 px-2">
                            <x-custom-label>C.P.</x-custom-label>
                            <div class="bg-white rounded-md text-center py-1 border 
                                border-cianna-gray">
                                <p>{{$casa->codigo_postal}}</p>
                            </div>
                        </div>
                        <div class="w-2/5 px-2">
                            <x-custom-label>Ciudad</x-custom-label>
                            <div class="bg-white rounded-md text-center py-1 border 
                                border-cianna-gray">
                                <p>{{$casa->ciudad}}</p>
                            </div>
                        </div>
                        <div class="w-2/5 px-2">
                            <x-custom-label>Colonia</x-custom-label>
                            <div class="bg-white rounded-md text-center py-1 border 
                                border-cianna-gray">
                                <p>{{$casa->colonia}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- DESCRIPCIÓN -->
                    <div class="flex flex-wrap mt-4 px-2">
                        <x-custom-label>Descripción del lugar</x-custom-label>
                        <div class="bg-white rounded-md justify-evenly border border-cianna-gray 
                            w-full px-4 py-2">
                            <p>
                            {{$casa->descripcion}}
                            </p>
                        </div>
                    </div>
                    <!-- REGLAS -->
                    <div class="flex flex-wrap mt-4">
                        <div class="w-[39%] pl-2">
                            <x-custom-label>Reglas</x-custom-label>
                            <div class="bg-white rounded-md px-1 py-1 border border-cianna-gray 
                                flex items-center">
                                <input type="checkbox" name="reglas[]" id="mascota" 
                                class="h-5 w-5 text-cianna-orange rounded-md" @if ($casa->acepta_mascotas == 'si') checked @endif disabled>
                                <label class="ml-2 text-sm">Se aceptan mascotas</label>
                            </div>
                            <div class="mt-2 bg-white rounded-md px-1 py-1 border border-cianna-gray 
                                flex items-center">
                                <input type="checkbox" name="reglas[]" id="visitas" 
                                class="h-5 w-5 text-cianna-orange rounded-md" @if ($casa->acepta_visitas == 'si') checked @endif disabled>
                                <label class="ml-2 text-sm">Se aceptan visitas</label>
                            </div>
                            <div class="mt-2 bg-white rounded-md px-1 py-1 border border-cianna-gray 
                                flex items-center">
                                <input type="checkbox" name="reglas[]" id="limpieza" 
                                class="h-5 w-5 text-cianna-orange rounded-md" @if ($casa->riguroza_limpieza == 'si') checked @endif disabled>
                                <label class="ml-2 text-sm">Rigurosa limpieza</label>
                            </div>
                        </div>
                        <div class="w-[61%] px-2">
                            <x-custom-label>Reglas extra</x-custom-label>
                            <div class="mt-2 bg-white rounded-md px-1 py-1 text-sm border border-cianna-gray 
                                flex items-center">
                                <p>
                                    @if(!$casa->regla_adicional)
                                    <p>No se especificaron reglas adicionales</p>
                                    @else
                                    <p>{{$casa->regla_adicional}}</p>
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div>
                                    <label class="text-sm font-bold">¿Incluye muebles?</label>
                                    <div class="flex items-center justify-between">
                                        <label>
                                            <input type="radio" name="muebles" id="muebles-s" 
                                            class="w-4 h-4 text-cianna-orange" @if ($casa->muebles == 'si') checked @endif disabled>
                                            Sí.
                                        </label>
                                        <label>
                                            <input type="radio" name="muebles" id="muebles-n" 
                                            class="w-4 h-4 text-cianna-orange" @if ($casa->muebles == 'no') checked @endif disabled>
                                            No.
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm font-bold">¿Incluye servicios?</label>
                                    <div class="flex items-center justify-between">
                                        <label>
                                            <input type="radio" name="servicios" id="servicios-s" 
                                            class="w-4 h-4 text-cianna-orange" @if ($casa->servicios == 'si') checked @endif disabled>
                                            Sí.
                                        </label>
                                        <label class="">
                                            <input type="radio" name="servicios" id="servicios-n" 
                                            class="w-4 h-4 text-cianna-orange" @if ($casa->servicios == 'no') checked @endif disabled>
                                            No.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- REQUISITOS -->
                    <div class="flex flex-wrap mt-4 px-2">
                        <x-custom-label>Requisitos</x-custom-label>
                        <div class="bg-white rounded-md justify-evenly border border-cianna-gray 
                            w-full px-4 py-2">
                            <p>
                            {{$casa->requisitos}}
                            </p>
                        </div>
                    </div>
                    <!-- PRECIO -->
                    <div class="w-full mt-4 px-2 flex justify-between items-end">
                        <div>
                            <x-custom-label>Precio</x-custom-label>
                            <div class="flex flex-row">
                                <div class="bg-gray-300 rounded-tl-md rounded-bl-md h-full 
                                    border border-cianna-gray">
                                    <i class="fa-solid fa-m ml-2 mt-1"></i>
                                    <i class="fa-solid fa-x mt-1"></i>
                                    <i class="fa-solid fa-n mt-1"></i>
                                    <i class="fa-solid fa-dollar-sign mt-1 mr-2"></i>
                                </div>
                                <div class="flex bg-white px-2 text-center
                                    border border-cianna-gray">
                                    <p class="text-gray-700">3,400.00</p>
                                </div>
                                <div class="bg-gray-300 px-1 text-center rounded-tr-md rounded-br-md h-full
                                    border border-cianna-gray">
                                    <p class="font-bold">/MES</p>
                                </div>
                            </div>
                            <div class="flex bg-white px-2 text-center
                                border border-cianna-gray">
                                <p class="text-gray-700">{{number_format($casa->precio, 2, '.', ',')}}</p>
                            </div>
                            <div class="bg-gray-300 px-1 text-center rounded-tr-md rounded-br-md h-full
                                border border-cianna-gray">
                                <p class="font-bold">/MES</p>
                            </div>
                        </div>
                        <button class="h-3/4 bg-cianna-gray hover:bg-gray-600 text-white font-bold py-2 px-4
                            rounded focus:outline-none focus:shadow-outline"
                            onclick="">
                            <i class="mr-2 fa-regular fa-star"></i>
                            Agregar a favoritos
                        </button>
                    </div>
                    <div class="w-full mt-4 px-2 flex justify-center">
                        <button class="w-1/2 bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                            rounded focus:outline-none focus:shadow-outline" 
                            onclick="">
                            <i class="mr-2 fa-solid fa-envelope-open-text"></i>
                            Postularse
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carouselItems = document.querySelectorAll('.carousel-item');
        let currentIndex = 0;

        function showCarouselItem(index) {
            carouselItems.forEach((item, i) => {
                item.style.display = (i === index) ? 'block' : 'none';
            });
        }

        document.getElementById('prevButton').addEventListener('click', function() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : carouselItems.length - 1;
            showCarouselItem(currentIndex);
        });

        document.getElementById('nextButton').addEventListener('click', function() {
            currentIndex = (currentIndex < carouselItems.length - 1) ? currentIndex + 1 : 0;
            showCarouselItem(currentIndex);
        });

        // Mostrar el primer ítem del carrusel
        showCarouselItem(currentIndex);
    });
</script>
