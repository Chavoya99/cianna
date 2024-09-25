<!-- resources/views/profile/roomie-details.blade.php -->
@props(['defaultImage' => asset('img/avatar-default-svgrepo-com.png'), 'num_mascotas' => 4,
        'padecimiento' => 'si', 'nom_padecimiento' => 'diabetes', 'lifestyle' => 'a',
        'tipoUsuario' => 'B'])
@section('title') {{ 'Detalles del roomie' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPPAL -->
    <div class="w-full">
        <!-- TÍTULO -->
        <div class="mt-8 px-20 w-1-2">
            <h1 class="text-cianna-orange text-3xl">Detalle de compañero</h1>
        </div>
        <!-- DETALLES -->
        <div class="flex w-full mt-8">
            <!-- CONTENEDOR IZQUIERDO -->
            <div class="relative w-1/2 pl-16 pr-4 items-center">
                <!-- IMAGEN DE PERFIL -->
                <div class="flex flex-col block w-full ml-20 mt-5">
                    <div class="inline-block relative h-[300px] w-[55%] overflow-hidden 
                        rounded-md bg-gray-100">
                        <img class="w-full h-full object-fill border-2 border-cianna-gray 
                        rounded-lg" src="{{ $defaultImage }}" 
                        alt="Imagen previa del roomie" />
                    </div>
                </div>
                <!-- EDAD Y SEXO -->
                <div class="w-3/4 ml-6 px-14 mt-4 flex justify-between">
                    <!-- EDAD -->
                    <div>
                        <x-custom-label class="text-center">Edad</x-custom-label>
                        <div class="bg-white rounded-md text-center py-1 px-12 
                            border border-cianna-gray">
                            <p>22</p>
                        </div>
                    </div>
                    <!-- SEXO -->
                    <div>
                        <x-custom-label class="text-center">Sexo</x-custom-label>
                        <div class="bg-white rounded-md text-center py-1 px-8 
                            border border-cianna-gray">
                        <p>Femenino</p>
                        </div>
                    </div>
                </div>
                <!-- CÓDIGO -->
                <div class="w-3/4 ml-6 mt-4 px-14">
                    <x-custom-label class="text-center">Código de estudiante</x-custom-label>
                    <div class="bg-white rounded-md text-center py-1 px-4 
                        border border-cianna-gray">
                        <p>123456789</p>
                    </div>
                </div>
                <!-- CARRERA -->
                <div class="w-3/4 ml-6 mt-4 px-14">
                    <x-custom-label class="text-center">Carrera</x-custom-label>
                    <div class="bg-white rounded-md text-center py-1 px-4 
                        border border-cianna-gray">
                        <p>Ing. Informática</p>
                    </div>
                </div>
            </div>
            <!-- CONTENEDOR DERECHO -->
            <div class="w-1/2 pl-8 mr-16">
                <!-- NOMBRE -->
                <div>
                    <h1 class="font-bold text-3xl line-clamp-1 text-center tracking-wide mt-6">
                        María Rebollar
                    </h1>
                    @if($tipoUsuario == 'A')
                        <!-- <--- HABILITAR PARA QUE ESTO VEA USUARIO A -->
                        <p class="text-center text-xs font-bold text-cianna-gray">
                            Está buscando habitación
                        </p>
                    @else
                        <!-- <--- HABILITAR PARA QUE ESTO VEA USUARIO B -->
                        <p class="text-center text-xs font-bold text-cianna-gray">
                            Está ofreciendo una habitación
                        </p>
                    @endif
                </div>
                <!-- DESRIPCIÓN -->
                <div class="text-justify tracking-wide leading-loose mt-4">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Nam nisl metus, feugiat ac dolor at, scelerisque vulputate magna. 
                        Nullam turpis nisl, viverra sed risus nec, consectetur sollicitudin quam. 
                        Nulla diam sapien, tristique eget orci ut, iaculis malesuada quam. 
                        Nam dui neque, ultricies sed lectus.
                    </p>
                </div>
                <!-- MASCOTAS Y PADECIMIENTO -->
                <div class="flex justify-between py-4">
                    <div>
                        <x-custom-label>¿Tienes mascotas?</x-custom-label>
                        <p>
                            {{ 
                                $num_mascotas 
                                ? 'Sí, tengo ' .$num_mascotas. ' mascota(s).' 
                                : 'No tengo mascotas'
                            }}
                        </p>
                    </div>
                    <div>
                        <x-custom-label>¿Tienes algún padecimiento médico?</x-custom-label>
                        @if($padecimiento == 'si')
                            @if($nom_padecimiento != 'N/A')
                                <p>Sí, padezco {{$nom_padecimiento}}.</p>
                            @else
                                <p>Sí (padecimiento no disponible).</p>
                            @endif
                        @else
                            <p>No tengo padecimientos médicos relevantes.</p>
                        @endif
                    </div>
                </div>
                <!-- LIFESTYLE -->
                <div>
                    <x-custom-label>¿Cuál dirías que es tu estilo de vida?</x-custom-label>
                    @if($lifestyle == 'd')
                        <p>Divertido, me gusta la fiesta.</p>
                    @elseif($lifestyle == 't')
                        <p>Tranquilo, prefiero no salir mucho.</p>
                    @elseif($lifestyle == 'a')
                        <p>Ni tan fiestero ni tan tranquilo, está bien tener un equilibrio.</p>
                    @endif
                </div>
                <!-- HABITACIÒN OFERTADA POR EL USUARIO A, OCULTAR LINK PARA ESTE MISMO -->
                @if($tipoUsuario == 'B')
                    <div>
                        <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                            href="">
                            <i class="fa-solid fa-bed mt-4 mr-2"></i>Ver habitación ofertada
                        </a>
                    </div>
                @endif
                <!-- HABITACIÒN OFERTADA POR EL USUARIO A, OCULTAR LINK PARA ESTE MISMO -->
                <!-- BOTONES FAVORITOS Y POSTULACIÓN -->
                <div class="flex justify-between py-4">
                    <div class="w-1/2 pr-1">
                        <button class="w-full bg-cianna-orange hover:bg-orange-300 text-white 
                            font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                            wire:click="favorito">
                            <i class="mr-2 fa-regular fa-star"></i>
                            Agregar a favoritos
                        </button>
                    </div>
                    <!-- OCULTAR BOTÓN POSTULACIÓN PARA USUARIOS TIPO A -->
                    @if($tipoUsuario == 'B')
                        <div class="w-1/2 pl-1">
                            <button class="w-full bg-cianna-blue hover:bg-sky-900 text-white 
                                font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                onclick="">
                                <i class="mr-2 fa-solid fa-envelope-open-text"></i>
                                Postularse
                            </button>
                        </div>
                    @endif
                    <!-- OCULTAR BOTÓN POSTULACIÓN PARA USUARIOS TIPO A -->
                </div>
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