<!-- resources/views/profile/favsB.blade.php -->
@section('title') {{ 'Favoritos' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="mt-8 ml-16 mr-16 w-4/5">
            <h1 class="font-bold text-3xl">Mis favoritos</h1>
        </div>
        <!-- MUESTRA DE FAVORITOS CON PAGINADOR -->
        <livewire:listado-favoritos-b/>
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative px-16 @if(count($favoritos) == 0) mt-40 @else mt-4 @endif">
            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                rounded focus:outline-none focus:shadow-outline" 
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>
