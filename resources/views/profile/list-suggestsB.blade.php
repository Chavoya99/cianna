<!-- resources/views/profile/list-suggestsB.blade.php -->
@props(['defaultRoomImage' => asset('img/img_prueba_casas/img_cuarto.jpg')])
@section('title')
    {{ 'Recomendaciones' }}
@endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="ml-16 mr-16 mt-8 text-3xl font-bold text-cianna-orange">
            <h1 class="text-3xl text-cianna-orange">Recomendado para ti</h1>
        </div>
        <div class="ml-16 mt-2">
            <p>Con base en en tus intereses creemos que podrían gustarte estos lugares</p>
        </div>
        <livewire:listado-recomendaciones-habitaciones />
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative mt-4 px-20">
            <button
                class="focus:shadow-outline rounded bg-cianna-blue px-4 py-2 font-bold text-white hover:bg-sky-900 focus:outline-none"
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>
