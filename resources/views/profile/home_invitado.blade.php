<!-- resources/views/profile/home_invitado.blade.php -->
@section('title')
    {{ 'Inicio' }}
@endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <div class="w-full">
        <div class="ml-16 mr-16 mt-8 text-3xl font-bold">¿Buscas una habitación?</div>
        <div class="ml-16 mt-2">Habitaciones ofertadas</div>
        <div class="ml-16 mr-16 mt-2 flex justify-between overflow-hidden">
            @foreach ($casas as $casa)
                <!-- IMAGEN CASA-->
                <div
                    class="mb-3 mt-5 flex w-1/4 transform flex-col px-5 transition-transform hover:scale-110">
                    <div class="block flex flex-col">
                        <div
                            class="relative inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100">
                            <a href="{{ route('vista_previa_casa', $casa) }}">
                                <img class="lazyload absolute left-0 top-0 h-full w-full rounded-lg border border-cianna-gray object-fill"
                                    data-src="{{ asset('storage/' . $casa->archivos->first()->ruta_archivo) }}"
                                    alt="Vista previa de la imagen del hogar" />
                            </a>
                        </div>
                    </div>
                    <!-- COLONIA -->
                    <a href="{{ route('vista_previa_casa', $casa) }}"
                        class="mt-2 line-clamp-1 text-lg font-semibold">

                        {{ $casa->colonia }}
                    </a>
                    <!-- DESCRIPCIÓN -->
                    <a href="{{ route('vista_previa_casa', $casa) }}" class="line-clamp-3 text-sm">
                        {{ $casa->descripcion }}
                    </a>
                    <!-- PRECIO -->
                    <a class="font-bold" href="{{ route('vista_previa_casa', $casa) }}">
                        $ {{ number_format($casa->precio, 2, '.', ',') }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mr-20 mt-2 text-right">

            <a class="ml-10 font-semibold text-cianna-green hover:text-cianna-orange"
                href="{{ route('listado_casas') }}">
                Más habitaciones...
            </a>
        </div>
    </div>
    <!-- ROOMIES -->
    <div class="w-full">
        <div class="ml-16 mr-16 mt-8 text-3xl font-bold">¿Buscas un compañero?</div>
            <div class="ml-16 mt-2">Compañeros buscando habitación</div>

        <div class="ml-16 mr-16 mt-2 flex justify-between overflow-hidden">
            @foreach ($roomies as $roomie)
                @php
                    $imagen = $roomie->user->archivos->first();
                @endphp
                <div
                    class="mx-3 flex w-1/5 transform flex-col py-3 transition-transform hover:scale-110">
                    <div class="block flex flex-col">
                        <div
                            class="relative inline-block h-48 w-full overflow-hidden rounded-md bg-gray-100">
                            <a href="{{ route('vista_previa_roomie', $roomie) }}">
                                <img class="lazyload absolute left-0 top-0 h-full w-full rounded-lg border border-cianna-gray object-cover"
                                    data-src="{{ asset('storage/' . $imagen->ruta_archivo) }}"
                                    alt="Vista previa de la imagen de perfil del roomie" />
                            </a>
                        </div>
                    </div>
                    <!-- NOMBRE ROOMIE -->
                    <a href="{{ route('vista_previa_roomie', $roomie) }}"
                        class="mt-2 line-clamp-1 text-lg font-semibold">
                        {{ $roomie->user->name }}
                    </a>
                    <!-- DESCRIPCIÓN ROOMIE -->
                    <a href="{{ route('vista_previa_roomie', $roomie) }}"
                        class="line-clamp-3 text-sm">
                        {{ $roomie->descripcion }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mr-20 mt-2 text-right">
            <a class="ml-10 font-semibold text-cianna-green hover:text-cianna-orange"
                href="{{ route('listado_roomies') }}">
                Más compañeros...
            </a>
        </div>
    </div>
</x-home-layout>
