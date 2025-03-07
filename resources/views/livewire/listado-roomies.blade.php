<!-- resources/livewire/listado-roomies.blade.php -->

<!-- Aquí solo pasamos la vista del for y el paginador -->
<div>
    <!-- MUESTRA DE ROOMIES -->
    <div class="mt-8 grid grid-cols-2 gap-6 px-16">
        @foreach ($roomies as $roomie)
            <div class="flex flex-col rounded-lg px-3 py-3">
                <div
                    class="relative flex transform overflow-hidden rounded-md transition-transform hover:scale-105">
                    <div class="h-52 w-52">
                        <a href="{{ route('vista_previa_roomie', $roomie) }}" class="w-1/2">
                            <img class="lazyload h-full w-full rounded-lg border border-cianna-gray bg-white object-cover"
                                data-src="{{ asset('storage/' . $roomie->user->archivos->first()->ruta_archivo) }}"
                                alt="Imagen previa del roomie" />
                        </a>
                    </div>
                    <div class="flex w-1/2 flex-col justify-center px-3 py-3">
                        <a href="{{ route('vista_previa_roomie', $roomie) }}"
                            class="line-clamp-1 text-lg font-semibold">
                            {{ $roomie->user->name . ' ' . $roomie->user->apellido }}
                        </a>
                        <a href="{{ route('vista_previa_roomie', $roomie) }}"
                            class="mt-1 line-clamp-1 text-justify text-sm font-semibold text-cianna-green">
                            {{ $carreras[$roomie->carrera] }}
                        </a>
                        <a href="{{ route('vista_previa_roomie', $roomie) }}"
                            class="mt-1 line-clamp-1 text-justify text-sm font-semibold text-gray-600">
                            {{ $roomie->edad }} años de edad
                        </a>
                        <a href="{{ route('vista_previa_roomie', $roomie) }}"
                            class="mt-1 line-clamp-3 text-justify text-sm">
                            {{ $roomie->descripcion }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    @if ($roomies->hasPages())
        <div class="mt-8 px-20">
            {{ $roomies->links() }}
        </div>
    @endif
</div>
