<!-- resources/views/profile/about-room.blade.php -->
@props(['defaultImage' => asset('img/img_prueba_casas/img_fachada.jpg')])
@section('title') {{ 'Ver más | Hogar' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TÍTULO -->
        <div class="mt-8 px-20 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Habitación</h1>
        </div>
        <!-- CONTENEDOR HORIZONTAL 1 -->
        <div class="flex mt-8 px-20">
            <!-- IMAGEN DEL HOGAR -->
            <div class="w-1/2">
                <div class="flex flex-col block w-full">
                    <div class="inline-block relative h-72 w-[85%] overflow-hidden 
                        rounded-md bg-gray-100">
                        <img class="w-full h-full object-fill border-2 border-cianna-gray 
                        rounded-lg" src="{{ asset('storage/'.$img_casa->ruta_archivo) }}" 
                        alt="Imagen previa del hogar" />
                    </div>
                </div>
            </div>
            <!-- INFORMACIÓN DEL HOGAR -->
            <div class="w-1/2 py-5 flex flex-col">
                <h1 class="font-bold text-3xl line-clamp-1">{{$casa->colonia}}</h1>
                <p class="mt-2 text-justify text-lg">
                {{$casa->descripcion}}
                </p>
                <p class="font-bold mt-4 mb-4 text-justify text-xl">
                $ {{number_format($casa->precio, 2, '.', ',')}}
                </p>
                <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                    href="{{route('detalles_casa', $casa)}}">
                    <i class="fa-solid fa-circle-info mr-2"></i>Ver detalles
                </a>
                <!-- OCULTAR BOTONES PARA USUARIO TIPO A -->
                @if(Auth::user()->tipo == 'B')
                    <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                        href="{{ route('detalles_roomie') }}">
                        <i class="fa-solid fa-address-card mt-4 mr-2"></i>Ver perfil del compañero
                    </a>
                    <livewire:favorite-button2 :casaId="$casa->id"/>
                    <button class="mt-4 w-3/4 bg-cianna-blue hover:bg-sky-900 text-white font-bold 
                        py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        onclick="">
                        <i class="mr-2 fa-solid fa-envelope-open-text"></i>
                        Postularse
                    </button>
                @endif
                
                <!-- OCULTAR BOTONES PARA USUARIO TIPO A -->
            </div>
        </div>
        <!-- CONTENEDOR HORIZONTAL TITULO 2 -->
        <div class="flex mt-8 px-20 font-bold">
            <p>Lugares que creemos te pueden gustar</p>
        </div>
        <!-- CONTENEDOR HORIZONTAL CASAS RECOMENDADAS -->
        <div class="flex mt-4 px-20">
            @foreach ($casasRecomendadas as $casa)
                <div class="w-1/3 flex flex-col py-3 pl-3 pr-3 transition-transform transform hover:scale-110">
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                            <a href="{{route('vista_previa_casa', $casa)}}">
                                <img class="object-cover w-full h-full absolute top-0 
                                left-0 border border-cianna-gray rounded-lg" 
                                        src="{{ asset('storage/'. $casa->archivos->first()->ruta_archivo)}}"
                                        alt="Imagen previa del hogar" />
                            </a>
                        </div>
                    </div>
                    <!-- COLONIA -->
                    <a href="{{route('vista_previa_casa', $casa)}}"
                        class="mt-2 text-lg font-semibold line-clamp-1">
                        {{$casa->colonia}}
                    </a>
                    <!-- DESCRIPCIÓN -->
                    <a href="{{route('vista_previa_casa', $casa)}}" 
                        class="text-sm line-clamp-2">
                        {{$casa->descripcion}}
                    </a>
                    <!-- PRECIO -->
                    <a class="font-bold" href="{{route('vista_previa_casa', $casa)}}">
                        $ {{number_format($casa->precio, 2, '.', ',')}}
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