<!-- resources/views/profile/about-roomie.blade.php -->
@props(['defaultImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{ 'Ver más | Roomie' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TÍTULO -->
        <div class="mt-8 px-20 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Compañero de cuarto</h1>
        </div>
        <!-- CONTENEDOR HORIZONTAL 1 -->
        <div class="flex mt-8 px-20">
            <!-- IMAGEN DEL ROOMIE -->
            <div class="w-1/2">
                <div class="flex flex-col block w-full ml-20 mt-5">
                    <div class="inline-block relative h-[330px] w-[60%] overflow-hidden 
                        rounded-md bg-gray-100">
                        <img class="w-full h-full object-fill border-2 border-cianna-gray 
                        rounded-lg" src="{{asset('storage/'.$rutaImagenPerfil)}}" 
                        alt="Imagen previa del roomie" />
                    </div>
                </div>
            </div>
            <!-- INFORMACIÓN DEL ROOMIE -->
            <div class="w-1/2 py-5 flex flex-col">
                <h1 class="font-bold text-3xl line-clamp-1">{{$roomie_v->user->name.' '.$roomie_v->user->apellido}}</h1> <!-- NOMBRE -->
                <p class="mt-2 text-justify text-lg"> <!-- DESCRIPCIÓN -->
                    {{$roomie_v->descripcion}}
                </p>
                <p class="font-bold mt-4 mb-4 text-justify text-xl"> <!-- CARRERA -->
                    {{$carrera}}
                </p>
                <a class="text-cianna-green font-semibold hover:text-cianna-orange" href="detalles_roomie">Ver detalles...</a>
                <!-- OCULTAR BOTONES PARA USUARIO TIPO B -->
                @if(Auth::user()->tipo == 'A')
                    <livewire:favorito-roomie-button :roomieId="$roomie_v->user_id" />
                    <button class="mt-4 w-3/4 bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                        rounded focus:outline-none focus:shadow-outline" 
                        onclick="">
                        <i class="mr-2 fa-solid fa-envelope-open-text"></i>
                        Postular
                    </button>
                @endif
                
                <!-- OCULTAR BOTONES PARA USUARIO TIPO B -->
            </div>
        </div>
        <!-- CONTENEDOR HORIZONTAL TITULO 2 -->
        <div class="flex mt-8 px-20 font-bold">
            <p>Otros compañeros de cuarto</p>
        </div>
        <!-- CONTENEDOR HORIZONTAL DE OTROS COMPAÑEROS -->
        <div class="flex mt-4 px-20">
            @foreach ($roomiesRecomendados as $roomie)
                <div class="w-1/4 flex flex-col py-3 pl-3 pr-3 transition-transform transform hover:scale-110">
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                            <a href="{{route('vista_previa_roomie', $roomie)}}">
                                <img class="object-fill w-full h-full absolute top-0 
                                left-0 border border-cianna-gray rounded-lg" 
                                src="{{asset('storage/'.$roomie->user->archivos->first()->ruta_archivo)}}"
                                alt="Imagen previa del roomie" />
                            </a>
                        </div>
                    </div>
                    <!-- Nombre -->
                    <a href="{{route('vista_previa_roomie', $roomie)}}" class="mt-2 text-lg font-semibold line-clamp-1">
                        {{$roomie->user->name}}
                    </a>
                    <!-- DESCRIPCIÓN -->
                    <a href="{{route('vista_previa_roomie', $roomie)}}" class="text-sm line-clamp-2">
                        {{$roomie->descripcion}}
                    </a>
                    <!-- CARRERA -->
                    <a href="{{route('vista_previa_roomie', $roomie)}}" class="font-bold">
                        {{$listaCarreras[$roomie->carrera]}}
                    </a>
                </div>
            @endforeach
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