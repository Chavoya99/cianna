<!-- resources/views/profile/suggestsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
@section('title') {{ 'Postulaciones | Pendientes' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TITULO -->
        <div class="font-bold text-3xl mt-8 ml-16 mr-16 text-cianna-orange">
            Postulaciones pendientes
        </div>
        <div class="mt-2 ml-16">
            Aquí están todas las postulaciones que has recibido y aún no han sido respondidas
        </div>
        <!-- MUESTRA DE POSTULACIONES CON PAGINACIÓN-->
        <livewire:postulaciones-pendientes-a>
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