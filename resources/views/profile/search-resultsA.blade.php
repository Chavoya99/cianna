<!-- resources/views/profile/search-resultsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title') {{ 'Resultados de la búsqueda' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Resultados de la búsqueda</h1>
        </div>
        <!-- MUESTRA DE ROOMIES -->
        <div>
            <!-- MUESTRA DE ROOMIES -->
            <div class="mt-8 px-16 grid grid-cols-2 gap-6">
                @foreach ($users as $user)
                    <div class="flex flex-col py-3 px-3 rounded-lg">
                        <div class="h-44 w-full overflow-hidden rounded-md flex relative transition-transform transform hover:scale-105">
                            <a href="{{route('detalles_roomie', $user)}}" class="w-1/2">
                                <img class="object-cover w-full h-full border border-cianna-gray bg-white rounded-lg" 
                                src="{{asset('Storage/'.$user->user->archivos->first()->ruta_archivo) }}" 
                                alt="Imagen previa del roomie" />
                            </a>
                            <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                                <a href="{{route('detalles_roomie', $user)}}" 
                                class="text-lg font-semibold line-clamp-1">
                                    {{$user->user->name.' '.$user->user->apellido}}
                                </a>
                                <a href="{{route('detalles_roomie', $user)}}" 
                                class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green font-semibold">
                                    {{$carreras[$user->carrera]}}
                                </a>
                                <a href="{{route('detalles_roomie', $user)}}" 
                                lass="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                                    {{$user->edad}} años de edad
                                </a>
                                <a href="{{route('detalles_roomie', $user)}}" 
                                class="text-sm text-justify line-clamp-3 mt-1">
                                    {{$user->descripcion}}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- ESPACIO PARA PAGINADOR -->
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
