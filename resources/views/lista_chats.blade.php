@props(['defaultProfileImage' => asset('img/selfie_mujer.jpg')])

@section('title') {{ 'Chats | Todos' }} @endsection

<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    
    <div class="px-16 mt-8">
        <!-- Título -->
        <div class="text-3xl font-bold border-b border-gray-300 pb-4">
            Chats
        </div>
        
        <livewire:lista-chats/>
        
        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
        <div class="relative mt-4">
            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                rounded focus:outline-none focus:shadow-outline" 
                onclick="window.history.back()">
                <i class="fa-solid fa-left-long mr-2"></i>Regresar
            </button>
        </div>
    </div>
</x-home-layout>
