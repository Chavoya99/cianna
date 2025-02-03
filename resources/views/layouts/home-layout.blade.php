<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans antialiased">
            <div class="flex pt-6 sm:pt-0 bg-cianna-white min-h-screen">
                <div class="w-3/20 overflow-hidden flex flex-col items-center px-2 py-4 bg-cianna-gray">
                    <div class="w-1/2 mt-6">
                        {{ $logo }}
                    </div>
                    <div class=" w-full flex flex-col mt-5">
                    <?php 
                        if(Illuminate\Support\Facades\Auth::user()->tipo == 'A'){
                            $ruta_home=route('homeA');
                        }else if(Illuminate\Support\Facades\Auth::user()->tipo == 'B'){
                            $ruta_home = route('homeB');
                        }else{
                            $ruta_home = route('dashboard');
                        } 
                    ?>
                    <x-home-buttons href="{{$ruta_home}}">
                        <i class="fa-solid fa-house mr-2"></i>
                        Inicio
                    </x-home-buttons>
                    <x-home-buttons href="{{route('ver_postulaciones')}}">
                        <i class="fa-solid fa-envelopes-bulk mr-2"></i>
                        Postulaciones
                    </x-home-buttons>
                    <x-home-buttons href="{{route('ver_favoritos')}}">
                        <i class="fa-solid fa-heart mr-2"></i>
                        Favoritos
                    </x-home-buttons>
                    <x-home-buttons href="{{route('lista_chats')}}">
                        <i class="fa-solid fa-comments mr-2"></i>
                        Chats
                    </x-home-buttons>
                    </div>
                </div>
                <div class="w-17/20 overflow-hidden py-6">
                    <!-- NavBar -->
                    @include('partials.navbar')
                    {{ $slot }}
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
    <!-- Footer -->
    @include('partials.footer')

    
</html>
