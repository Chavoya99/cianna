<!-- resources/views/profile/homes-list.blade.php -->
@props(['defaultImage' => asset('img/img_prueba_casas/img_fachada.jpg')])
@section('title') {{ 'Habitaciones disponibles' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Más habitaciones disponibles</h1>
        </div>
        <!-- MUESTRA DE HABITACIONES CON PAGINADOR -->
        <livewire:listado-habitaciones/>
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
