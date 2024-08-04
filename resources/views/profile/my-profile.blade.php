<!-- resources/views/profile/my-profile.blade.php -->
@props($images = [
        'img_banio.jpg',
        'img_cocina.jpg',
        'img_cuarto.jpg',
        'img_fachada.jpg',
        'img_sala.jpg',
        'img_banio.jpg',
    ])
@section('title') {{ 'Mi perfil' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!--MENSAJES DE ERROR -->
    <x-validation-errors/>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TÍTULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Mi perfil</h1>
        </div>
        <!-- CONTENEDOR HORIZONTAL 1 -->
        <div class="flex w-full mt-8">
                <!-- CONTENEDOR DESCRIPCIÓN -->
                <div class="relative w-[60%] px-16">
                    <label class="font-bold">Sobre ti</label>
                    <p class="text-justify">{{$usuario->descripcion}}</p>
                </div>
                <!-- CONTENEDOR SUP/DER FOTO DE PERFIL -->
                <div class="w-[40%] px-28">
                    <div class="flex flex-col items-center py-3">
                        <div class="flex flex-col items-center block w-full">
                            <div id="imageContainer" class="inline-block h-40 w-40 overflow-hidden 
                                rounded-md bg-gray-100 mb-2">
                                <img id="preview" class="object-cover border border-cianna-gray 
                                rounded-lg" src="{{asset('storage/'.$img_perfil->ruta_archivo)}}" 
                                alt="Imagen de perfil" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 1 -->

            <!-- CONTENEDOR HORIZONTAL 2 -->
            <div class="flex w-full">
                <!-- CONTENEDOR IZQ MASCOTAS -->
                <div class="relative w-[60%] px-16">
                    <x-custom-label for="mascota">
                        ¿Tienes mascotas?
                    </x-custom-label>
                    <div class="flex items-center flex-wrap">
                            @if($usuario->mascota == 'si')
                                <p>Sí, tengo {{$usuario->num_mascotas}} mascota(s).</p>
                            @else
                                <p>No tengo mascotas</p>
                            @endif
                    </div>
                </div>
                <!-- CONTENEDOR DER EDAD Y SEXO-->
                <div class="w-[40%] px-28">
                    <div class="flex justify-between">
                        <div class="w-28">
                            <x-custom-label for="edad" class="text-center">Edad</x-custom-label>
                            <input id="edad" name="edad" class="w-28 text-gray-500 text-center 
                            border border-cianna-gray rounded-md" 
                            type="number" value="{{ $usuario->edad }}" disabled>
                        </div>
                        <div class="w-28">
                            <x-custom-label for="sexo" class="text-center">Sexo</x-custom-label>
                                <input id="sexo" name="sexo" class="w-28 block text-gray-500 
                                text-center border border-cianna-gray rounded-md" 
                                type="text" value="{{ $usuario->sexo }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 2 -->

            <!-- CONTENEDOR HORIZONTAL 3 -->
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ PADECIMIENTOS -->
                <div class="relative px-16 w-[60%]">
                    <x-custom-label for="mascota">
                        ¿Tienes algún padecimiento médico?
                    </x-custom-label>
                    <div class="flex items-center flex-wrap">
                            @if($usuario->padecimiento == 'si')
                                @if($usuario->nom_padecimiento != 'N/A')
                                    <p>Sí, padezco {{$usuario->nom_padecimiento}}.</p>
                                @else
                                    <p>Sí (padecimiento no disponible).</p>
                                @endif
                            @else
                                <p>No tengo padecimientos médicos relevantes.</p>
                            @endif
                    </div>
                </div>
                <!-- CONTENEDOR DER CODIGO-->
                <div class="w-[40%] px-28">
                    <x-custom-label class="text-center">Código de estudiante</x-custom-label>
                    <input id="codigo" name="codigo" class="block w-full text-gray-500 text-center 
                    border border-cianna-gray rounded-md" type="text" value="{{$usuario->codigo}}" 
                    disabled>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 3 -->

            <!-- CONTENEDOR HORIZONTAL 4 -->
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ PADECIMIENTOS -->
                <div class="relative px-16 w-[60%]">
                    <x-custom-label for="mascota">
                        ¿Cual dirías que es tu estilo de vida?
                    </x-custom-label>
                    <div class="flex items-center flex-wrap">
                            @if($usuario->lifestyle == 'd')
                                <p>Divertido, me gusta la fiesta.</p>
                            @elseif($usuario->lifestyle == 't')
                                <p>Tranquilo, prefiero no salir mucho.</p>
                            @elseif($usuario->lifestyle == 'a')
                                <p>Ni tan fiestero ni tan tranquilo, está bien tener un equilibrio.
                                </p>
                            @endif
                    </div>
                </div>
                <!-- CONTENEDOR DER CARRERA -->
                <div class="w-[40%] px-28">
                    <x-custom-label class="text-center">Carrera</x-custom-label>
                    <div class="block w-full bg-white text-gray-500 text-center 
                        border border-cianna-gray rounded-md py-2">
                        {{$carrera}}
                    </div>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 4 -->

            <!-- CONTENEDOR HORIZONTAL 5 -->
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ PADECIMIENTOS -->
                <div class="relative px-16 w-[60%]">
                    <x-custom-label for="mascota">
                        ¿Estás ofreciendo una habitación?
                    </x-custom-label>
                    <div class="flex items-center flex-wrap">
                            @if($usuario->user->tipo == 'A')
                                <p>Sí, ya tengo un lugar y estoy buscando compartirlo.</p>
                            @else
                                <p>No, estoy buscando una habitación.</p>
                            @endif
                    </div>
                </div>
                <!-- CONTENEDOR DER KARDEX -->
                <div class="w-[40%] px-28">
                    <form action="{{route('ver_kardex', Auth::user())}}" method="POST" target='_blank'>
                        @csrf
                        <button type="submit" class="block w-full bg-cianna-orange hover:bg-orange-300 text-white 
                             py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:font-bold">
                            <i class="fa-solid fa-file"></i> Haz clic aquí para ver tu kárdex
                        </button>
                    </form>
                    <br>
                    <form action="{{route('descargar_kardex', Auth::user())}}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full bg-cianna-orange hover:bg-orange-300 text-white 
                             py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:font-bold">
                            <i class="fa-solid fa-download"></i> Descargar Kardex
                        </button>
                    </form>
                    
                    
                    
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 5 -->

            <!-- CONTENEDOR HORIZONTAL 6 -->
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ IMG CASA -->
                <div class="relative px-16 w-[60%]">
                    <x-custom-label class="text-xl">Mi casa</x-custom-label>
                    <div class="relative w-full overflow-hidden">
                        <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
                            @foreach ($images as $image)
                                <div class="flex-none w-1/3 p-2">
                                    <img src="{{ asset('img/img_prueba_casas/' . $image) }}" 
                                    alt="Imagen {{ $loop->index + 1 }}" 
                                    class="w-full h-[160px] rounded-lg shadow-md">
                                </div>
                            @endforeach
                        </div>
                        <button id="prev" class="absolute left-0 top-1/2 transform -translate-y-1/2 
                            bg-cianna-blue text-white px-3 py-1 rounded-l-lg">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button id="next" class="absolute right-0 top-1/2 transform -translate-y-1/2
                            bg-cianna-blue text-white px-3 py-1 rounded-r-lg">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                        <a class="flex justify-end font-semibold text-cianna-green 
                            hover:text-cianna-orange" href="home-details">Ver detalles
                        </a>
                </div>
                <!-- CONTENEDOR DER -->
                <div class="w-[40%] px-28"></div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 6 -->

            <!-- CONTENEDOR HORIZONTAL 7 -->
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ BOTÓN REGRESAR -->
                <div class="relative px-16 w-[60%]">
                    <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                        rounded focus:outline-none focus:shadow-outline" 
                        onclick="window.history.back()">
                        <i class="fa-solid fa-left-long mr-2"></i>Regresar
                    </button>
                </div>
                <!-- CONTENEDOR DER BOTÓN AJUSTES -->
                <div class="w-[40%] px-28">
                    <a href="{{route('config_cuenta')}}" class="block w-full bg-cianna-blue 
                        hover:bg-sky-900  text-white text-center font-bold py-2 px-4 rounded 
                        focus:outline-none focus:shadow-outline">
                        <i class="fa-solid fa-gear mr-2"></i>Ajustes
                    </a>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 7 -->
    </div>
</x-home-layout>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carousel = document.getElementById('carousel');
        const prev = document.getElementById('prev');
        const next = document.getElementById('next');
        const totalImages = {{ count($images) }};
        const visibleImages = 3;
        const imageWidth = carousel.firstElementChild.offsetWidth;
        let currentIndex = 0;

        prev.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                carousel.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
            }
        });

        next.addEventListener('click', () => {
            if (currentIndex < totalImages - visibleImages) {
                currentIndex++;
                carousel.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
            }
        });
    });
</script>