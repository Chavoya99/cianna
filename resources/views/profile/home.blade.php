<!-- resources/views/profile/home.blade.php -->
@section('title') {{ 'Inicio' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas una habitación?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
            @foreach ($casas as $casa)
                <!-- IMAGEN CASA-->
                <div class="w-1/4 flex flex-col mt-5 mb-3 px-5 transition-transform 
                    transform hover:scale-110">
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md 
                            bg-gray-100 relative">
                            <a href="{{route('vista_previa_casa', $casa)}}">
                                <img class="object-cover w-full h-full absolute top-0 left-0 
                                border border-cianna-gray rounded-lg" 
                                src="{{ asset('storage/'. $casa->archivos->first()->ruta_archivo)}}" 
                                alt="Vista previa de la imagen del hogar" />
                            </a>
                        </div>
                    </div>
                    <!-- COLONIA -->
                    <a href="{{route('vista_previa_casa', $casa)}}" 
                        class="mt-2 text-lg font-semibold line-clamp-1">
                        {{ $casa->colonia }}
                    </a>
                    <!-- DESCRIPCIÓN -->
                    <a href="{{route('vista_previa_casa', $casa)}}" 
                        class="text-sm line-clamp-3">
                        {{ $casa->descripcion }}
                    </a>
                    <!-- PRECIO -->
                    <a class="font-bold" 
                        href="{{route('vista_previa_casa', $casa)}}">
                        $ {{number_format($casa->precio, 2, '.', ',')}}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-right mr-20 mt-2">
            @if (Auth::user()->tipo == 'B')
                <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                    href="">
                    Habitaciones recomendadas...
                </a>
            @endif
            <a class="ml-10 text-cianna-green font-semibold hover:text-cianna-orange" 
                href="{{route('listado_casas')}}">
                Más habitaciones...
            </a>
        </div>
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
                <div class="w-1/6 flex flex-col py-3 pl-3 pr-3 transition-transform 
                    transform hover:scale-110">
                    <div class="flex flex-col block">
                        <div class="inline-block h-36 w-full overflow-hidden rounded-md 
                            bg-gray-100 relative">
                            <a href="{{route('vista_previa_roomie', $roomie)}}">
                                <img class="object-cover w-full h-full absolute top-0 left-0 
                                border border-cianna-gray rounded-lg" 
                                src="{{ asset('storage/'. $imagen->ruta_archivo) }}" 
                                alt="Vista previa de la imagen de perfil del roomie"/>
                            </a>
                        </div>
                    </div>
                    <!-- NOMBRE ROOMIE -->
                    <a href="{{route('vista_previa_roomie', $roomie)}}"
                        class="mt-2 text-lg font-semibold line-clamp-1">
                        {{ $roomie->user->name }}
                    </a>
                    <!-- DESCRIPCIÓN ROOMIE -->
                    <a href="{{route('vista_previa_roomie', $roomie)}}" class="text-sm line-clamp-3">
                        {{ $roomie->descripcion }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-right mr-20 mt-2">
            @if (Auth::user()->tipo == 'A')
                <a class="text-cianna-green font-semibold hover:text-cianna-orange" 
                    href="">
                    Compañeros recomendados...
                </a>
            @endif
            <a class="ml-10 text-cianna-green font-semibold hover:text-cianna-orange" 
                href="{{route('listado_roomies')}}">
                Más compañeros...
            </a>
        </div>
    </div>
</x-home-layout>


