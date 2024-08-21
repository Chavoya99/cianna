<!-- resources/views/profile/home.blade.php -->
@props(['defaultHomeImage' => asset('img/home-add-svgrepo-com.png'), 'defaultProfileImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{ 'Inicio' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un hogar?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
            @foreach ($casas as $casa)
                @php
                    $imagen = $casa->archivos->first();
                @endphp
                
                <!-- IMAGEN CASA-->
                <div class="w-1/4 flex flex-col py-3 pl-3 pr-3 transition-transform transform hover:scale-110">
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                            <a href="ver_mas_hogar">
                                <img class="object-cover w-full h-full absolute top-0 
                                left-0 border border-cianna-gray rounded-lg" 
                                     src="{{ asset('storage/'. $imagen->ruta_archivo) }}" 
                                     alt="Imagen previa del hogar" />
                            </a>
                        </div>
                    </div>
                    <!-- COLONIA -->
                    <a href="ver_mas_hogar" class="mt-2 text-lg font-semibold line-clamp-1">{{ $casa->colonia }}</a>
                    <!-- DESCRIPCIÓN -->
                    <a href="ver_mas_hogar" class="text-sm line-clamp-3">{{ $casa->descripcion }}</a>
                </div>
            @endforeach
        </div>
        <div class="text-right mr-20 mt-2"><a class="text-cianna-green font-semibold hover:text-cianna-orange" 
        href="see-homes">Más hogares...</a></div>
    </div>
    <!-- ROOMIES -->
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un compañero de cuarto?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
            @foreach ($roomies as $roomie)
                @php
                    $imagen = $roomie->user->archivos->first();
                @endphp
                <div class="w-1/6 flex flex-col py-3 pl-3 pr-3 transition-transform transform hover:scale-110">
                    <div class="flex flex-col block">
                        <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                            <a href="detalles_roomie">
                                <img class="object-cover w-full h-full absolute top-0 
                                left-0 border border-cianna-gray rounded-lg" 
                                     src="{{ asset('storage/'. $imagen->ruta_archivo) }}" 
                                     alt="Imagen previa roomie" />
                            </a>
                        </div>
                    </div>
                    <!-- NOMBRE ROOMIE -->
                    <a href="detalle-roommie-1" class="mt-2 text-lg font-semibold line-clamp-1">{{ $roomie->user->name }}</a>
                    <!-- DESCRIPCIÓN ROOMIE -->
                    <a href="detalle-roommie-1" class="text-sm line-clamp-3">{{ $roomie->descripcion }}</a>
                </div>
            @endforeach
        </div>
        <div class="text-right mr-20 mt-2">
            <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
            href="see-rommies">Más compañeros...</a>
        </div>
    </div>
</x-home-layout>


