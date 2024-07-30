<!-- resources/views/profile/my-profile.blade.php -->
@props(['desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eu tempus nisi. 
                        Donec ut enim finibus, malesuada risus vitae, pulvinar enim. 
                        Pellentesque aliquet neque a bibendum tincidunt. 
                        Orci varius natoque penatibus et magnis dis parturient montes, 
                        nascetur ridiculus mus. Donec quis laoreet in.',
        'edad' => 22, 'sexo' => 'Masculino', 'tipo' => 'A', 'mascota' => 'si', 'num_mascotas' => 2, 
        'padecimiento' => 'si', 'nom_padecimiento' => 'migraña', 'codigo' => '217590707',
        'lifestyle' => 'a' , 'carrera' => 'Ing. en Telecomunicaciones y Electrónica',
        'defaultImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{ 'Mi perfil' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
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
                    <p class="text-justify">{{$desc}}</p>
                </div>
                <!-- CONTENEDOR SUP/DER FOTO DE PERFIL -->
                <div class="w-[40%] px-28">
                    <div class="flex flex-col items-center py-3">
                        <div class="flex flex-col items-center block w-full">
                            <div id="imageContainer" class="inline-block h-40 w-40 overflow-hidden 
                                rounded-md bg-gray-100 mb-2">
                                <img id="preview" class="object-cover border border-cianna-gray 
                                rounded-lg" src="{{ $defaultImage }}" alt="Imagen previa" />
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
                            @if($mascota == 'si')
                                <p>Sí, tengo {{$num_mascotas}} mascotas.</p>
                            @else
                                <p>No, no tengo mascotas</p>
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
                            type="number" value="{{ $edad }}" disabled>
                        </div>
                        <div class="w-28">
                            <x-custom-label for="sexo" class="text-center">Sexo</x-custom-label>
                                <input id="sexo" name="sexo" class="w-28 block text-gray-500 
                                text-center border border-cianna-gray rounded-md" 
                                type="text" value="{{ $sexo }}" disabled>
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
                            @if($padecimiento == 'si')
                                <p>Sí, padezco {{$nom_padecimiento}}.</p>
                            @else
                                <p>No, no tengo padecimientos médicos relevantes.</p>
                            @endif
                    </div>
                </div>
                <!-- CONTENEDOR DER CODIGO-->
                <div class="w-[40%] px-28">
                    <x-custom-label class="text-center">Código de estudiante</x-custom-label>
                    <input id="codigo" name="codigo" class="block w-full text-gray-500 text-center 
                    border border-cianna-gray rounded-md" type="text" value="{{$codigo}}" disabled>
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
                            @if($lifestyle == 'd')
                                <p>Divertido, me gusta la fiesta.</p>
                            @elseif($lifestyle == 't')
                                <p>Tranquilo, prefiero no salir mucho.</p>
                            @elseif($lifestyle == 'a')
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
                            @if($tipo == 'A')
                                <p>Sí, ya tengo un lugar y estoy buscando compartirlo.</p>
                            @else
                                <p>No, estoy buscando una habitación.</p>
                            @endif
                    </div>
                </div>
                <!-- CONTENEDOR DER KARDEX -->
                <div class="w-[40%] px-28">
                    <button class="block w-full bg-cianna-orange hover:bg-orange-300 text-white 
                        py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:font-bold">
                        <i class="fa-solid fa-download"></i> Haz clic aquí para ver tu kárdex
                    </button>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 5 -->

            <!-- CONTENEDOR HORIZONTAL 6 -->
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ BOTÓN REGRESAR -->
                <div class="relative px-16 w-[60%]">
                    <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                    rounded focus:outline-none focus:shadow-outline" 
                    onclick="window.history.back()">
                    <i class="fa-solid fa-left-long"></i> Regresar
                    </button>
                </div>
                <!-- CONTENEDOR DER BOTÓN AJUSTES -->
                <div class="w-[40%] px-28">
                    <a href="account-settings" class="block w-full bg-cianna-blue hover:bg-sky-900 
                    text-white text-center font-bold py-2 px-4 rounded focus:outline-none 
                    focus:shadow-outline">
                    <i class="fa-solid fa-gear"></i> Ajustes</a>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 6 -->
    </div>
</x-home-layout>
