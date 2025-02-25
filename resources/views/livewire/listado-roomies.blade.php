<!-- resources/livewire/listado-roomies.blade.php -->

<!-- Aquí solo pasamos la vista del for y el paginador -->
<div>
    <!-- MUESTRA DE ROOMIES -->
    <div class="mt-8 px-16 grid grid-cols-2 gap-6">
        @foreach ($roomies as $roomie)
            <div class="flex flex-col py-3 px-3 rounded-lg">
                <div class="h-44 w-full overflow-hidden rounded-md flex relative transition-transform transform hover:scale-105">
                    <a href="{{route('vista_previa_roomie', $roomie)}}" class="w-1/2">
                        <img class="object-cover w-full h-full border border-cianna-gray 
                             bg-white rounded-lg lazyload" 
                             data-src="{{ asset('storage/'.$roomie->user->archivos->first()->ruta_archivo) }}" 
                             alt="Imagen previa del roomie" />
                    </a>
                    <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                        <a href="{{route('vista_previa_roomie', $roomie)}}" class="text-lg font-semibold line-clamp-1">
                            {{$roomie->user->name.' '.$roomie->user->apellido}}
                        </a>
                        <a href="{{route('vista_previa_roomie', $roomie)}}" class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green font-semibold">
                            {{$carreras[$roomie->carrera]}}
                        </a>
                        <a href="{{route('vista_previa_roomie', $roomie)}}" class="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                            {{$roomie->edad}} años de edad
                        </a>
                        <a href="{{route('vista_previa_roomie', $roomie)}}" class="text-sm text-justify line-clamp-3 mt-1">
                            {{$roomie->descripcion}}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    @if($roomies->hasPages())
        <div class="mt-8 px-20">
            {{ $roomies->links() }}
        </div>
    @endif
</div>

