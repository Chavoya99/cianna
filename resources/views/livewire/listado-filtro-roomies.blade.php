<!-- resources/livewire/listado-filtro-roomies.blade.php -->
<!-- MUESTRA DE ROOMIES -->
<div>
    <!-- MUESTRA DE ROOMIES -->
    <div class="mt-8 grid grid-cols-2 gap-6 px-16">
        @foreach ($users as $user)
            <div class="flex flex-col rounded-lg px-3 py-3">
                <div
                    class="relative flex h-44 w-full transform overflow-hidden rounded-md transition-transform hover:scale-105">
                    <a href="{{ route('detalles_roomie', $user) }}" class="w-1/2">
                        <img class="lazyload h-full w-full rounded-lg border border-cianna-gray bg-white object-cover"
                            data-src="{{ asset('Storage/' . $user->user->archivos->first()->ruta_archivo) }}"
                            alt="Imagen previa del roomie" />
                    </a>
                    <div class="flex w-1/2 flex-col justify-center px-3 py-3">
                        <a href="{{ route('detalles_roomie', $user) }}"
                            class="line-clamp-1 text-lg font-semibold">
                            {{ $user->user->name . ' ' . $user->user->apellido }}
                        </a>
                        <a href="{{ route('detalles_roomie', $user) }}"
                            class="mt-1 line-clamp-1 text-justify text-sm font-semibold text-cianna-green">
                            {{ $careers[$user->carrera] }}
                        </a>
                        <a href="{{ route('detalles_roomie', $user) }}"
                            lass="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                            {{ $user->edad }} años de edad
                        </a>
                        <a href="{{ route('detalles_roomie', $user) }}"
                            class="mt-1 line-clamp-3 text-justify text-sm">
                            {{ $user->descripcion }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Paginación -->
    @if ($users->hasPages())
        <div class="mt-8 px-20">
            {{ $users->links() }}
        </div>
    @endif
</div>
