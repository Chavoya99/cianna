<!-- resources/views/profile/search-resultsB.blade.php -->
@props(['defaultImage' => asset('img/img_prueba_casas/img_fachada.jpg')])
@section('title')
    {{ 'Resultados de la búsqueda' }}
@endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="ml-16 mr-16 mt-8 w-4/5">
            <h1 class="text-3xl text-cianna-orange">Resultados de la búsqueda</h1>
        </div>
        <!-- RESULTADOS CON PAGINADOR -->
        <livewire:listado-filtro-habitaciones>
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
