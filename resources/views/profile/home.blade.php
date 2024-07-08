<!-- resources/views/home.blade.php -->
@props(['defaultHomeImage' => asset('img/home-add-svgrepo-com.png'), 'defaultProfileImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{'Inicio'}} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un hogar?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
            <!-- IMAGEN CASA 1 -->
            <div class="w-1/4 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-home-1"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultHomeImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- COLONIA -->
                <a href="detalle-home-1" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN -->
                <a href="detalle-home-1" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN CASA 2 -->
            <div class="w-1/4 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-home-2"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultHomeImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- COLONIA -->
                <a href="detalle-home-2" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN -->
                <a href="detalle-home-2" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN CASA 3 -->
            <div class="w-1/4 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-home-3"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultHomeImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- COLONIA -->
                <a href="detalle-home-3" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN -->
                <a href="detalle-home-3" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN CASA 4 -->
            <div class="w-1/4 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-home-4"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultHomeImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- COLONIA -->
                <a href="detalle-home-4" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN -->
                <a href="detalle-home-4" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
        </div>
        <div class="text-right mr-20 mt-2"><a class="text-cianna-green font-semibold hover:text-cianna-orange" href="see-homes">Ver más...</a></div>
    </div>
    <!-- ROOMIES -->
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un compañero de cuarto?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
            <!-- IMAGEN ROOMMIE 1 -->
            <div class="w-1/6 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-roommie-1"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultProfileImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- NOMBRE ROOMIE -->
                <a href="detalle-roommie-1" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN ROOMIE -->
                <a href="detalle-roommie-1" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN ROOMMIE 2 -->
            <div class="w-1/6 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-roommie-2"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultProfileImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- NOMBRE ROOMIE -->
                <a href="detalle-roommie-2" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN ROOMIE -->
                <a href="detalle-roommie-2" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN ROOMMIE 3 -->
            <div class="w-1/6 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-roommie-3"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultProfileImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- NOMBRE ROOMIE -->
                <a href="detalle-roommie-3" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN ROOMIE -->
                <a href="detalle-roommie-3" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN ROOMMIE 4 -->
            <div class="w-1/6 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-roommie-4"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultProfileImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- NOMBRE ROOMIE -->
                <a href="detalle-roommie-4" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN ROOMIE -->
                <a href="detalle-roommie-4" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN ROOMMIE 5 -->
            <div class="w-1/6 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-roommie-5"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultProfileImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- NOMBRE ROOMIE -->
                <a href="detalle-roommie-5" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN ROOMIE -->
                <a href="detalle-roommie-5" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
            <!-- IMAGEN ROOMMIE 6 -->
            <div class="w-1/6 flex flex-col py-3 pr-3">
                <div class="flex flex-col block">
                    <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                        <a href="detalle-roommie-6"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                        src="{{ $defaultProfileImage }}" alt="Imagen previa del hogar" /></a>
                    </div>
                </div>
                <!-- NOMBRE ROOMIE -->
                <a href="detalle-roommie-6" class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </a>
                <!-- DESCRIPCIÓN ROOMIE -->
                <a href="detalle-roommie-6" class="text-sm line-clamp-3">Lorem ipsum dolor sit amet,
                consectetur adipiscing elit. In consectetur libero non nunc ullamcorper,
                in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</a>
            </div>
        </div>
        <div class="text-right mr-20 mt-2"><a class="text-cianna-green font-semibold hover:text-cianna-orange" href="see-rommies">Ver más...</a></div>
    </div>
</x-home-layout>
