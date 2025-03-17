<!-- resources/views/profile/suggestsA.blade.php -->
@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])
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
            Recomendado para ti
        </div>
        <div class="ml-16 mt-2">
            Con base en tus favoritos creemos que podrían ser más compatibles contigo
        </div>
        @if (isset($error_message))
            <div class="rounded-md bg-red-500 p-4 text-white">
                {{ $error_message }}
            </div>
        @endif
        <livewire:listado-recomendaciones-roomies />
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
