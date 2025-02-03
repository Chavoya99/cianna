<!-- resources/views/profile/favsA.blade.php -->
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
        <!-- MUESTRA DE FAVORITOS CON PAGINADOR Y BOTÓN REGRESAR-->
        <livewire:listado-favoritos-a/>
    </div>
</x-home-layout>
