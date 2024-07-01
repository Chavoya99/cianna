<!-- resources/views/home.blade.php -->
@props(['defaultImage' => asset('img/home-add-svgrepo-com.png')])
@section('title') {{'Inicio'}} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <div class="w-full bg-red-500">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un hogar?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 bg-blue-300 overflow-hidden">
            <!-- IMAGEN CASA 1 -->
            <div class="w-1/4 flex flex-col py-3 pr-3 bg-pink-300">
                <div class="flex flex-col block bg-red-600">
                    <div class="inline-block h-40 w-full overflow-hidden rounded-md bg-gray-100">
                        <img class="object-cover border border-cianna-gray rounded-lg" src="{{ $defaultImage }}" alt="Imagen previa" />
                    </div>
                </div>
                <h1 class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </h1>
                <p class="text-sm line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</p>
            </div>
            <!-- IMAGEN CASA 2 -->
            <div class="w-1/4 flex flex-col py-3 pr-3 pl-3 bg-pink-300">
                <div class="flex flex-col block bg-red-600">
                    <div class="inline-block h-40 w-full overflow-hidden rounded-md bg-gray-100">
                        <img class="object-cover border border-cianna-gray rounded-lg" src="{{ $defaultImage }}" alt="Imagen previa" />
                    </div>
                </div>
                <h1 class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </h1>
                <p class="text-sm line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</p>
            </div>
            <!-- IMAGEN CASA 3 -->
            <div class="w-1/4 flex flex-col py-3 pr-3 pl-3 bg-pink-300">
                <div class="flex flex-col block bg-red-600">
                    <div class="inline-block h-40 w-full overflow-hidden rounded-md bg-gray-100">
                        <img class="object-cover border border-cianna-gray rounded-lg" src="{{ $defaultImage }}" alt="Imagen previa" />
                    </div>
                </div>
                <h1 class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </h1>
                <p class="text-sm line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</p>
            </div>
            <!-- IMAGEN CASA 4 -->
            <div class="w-1/4 flex flex-col py-3 pl-3 bg-pink-300">
                <div class="flex flex-col block bg-red-600">
                    <div class="inline-block h-40 w-full overflow-hidden rounded-md bg-gray-100">
                        <img class="object-cover border border-cianna-gray rounded-lg" src="{{ $defaultImage }}" alt="Imagen previa" />
                    </div>
                </div>
                <h1 class="mt-2 text-lg font-semibold line-clamp-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin. </h1>
                <p class="text-sm line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur libero non nunc ullamcorper, in fermentum purus aliquet. Morbi ultricies dapibus odio eu sollicitudin.</p>
            </div>
        </div>
        <div class="text-right mr-16 mt-2"><a href="see-homes">Ver más...</a></div>
    </div>
    <div class="w-full bg-red-500">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un compañero de cuarto?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="text-right mr-16"><a href="see-rommies">Ver más...</a></div>
    </div>
</x-home-layout>
