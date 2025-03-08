<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>
@section('title')
    {{ 'Inicia sesión' }}
@endsection
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-custom-input id="email" class="mt-1 block w-full" type="email"
                    name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="Correo" />
            </div>
            <p id="error" class="text-red-500 text-xs hidden">El correo que ingresaste no está permitido. Usa tu correo institucional</p>

            <div class="relative mt-8">
                <x-custom-input id="password" class="mt-1 block w-full" type="password"
                    name="password" required autocomplete="current-password"
                    placeholder="Contraseña" />
                <button type="button" onclick="togglePasswordVisibility()"
                    class="absolute inset-y-0 right-0 px-3 py-2 text-gray-500">
                    <!-- Icono para mostrar la contraseña -->
                    <i id="show-icon" class="fas fa-eye bg-white"></i>
                    <!-- Icono para ocultar la contraseña -->
                    <i id="hide-icon" class="fas fa-eye-slash hidden bg-white"></i>
                </button>
            </div>

            <div class="mt-4 block">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        href="{{ route('password.request') }}">
                        {{ __('Olvidé mi contraseña') }}
                    </a>
                @endif
            </div>

            <div class="mt-4 flex items-center justify-end">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Registrarme</a>
                @endif

                <x-button class="ms-4">
                    {{ __('Ingresar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
<!-- Footer -->
@include('partials.footer')

<!-- ALTERNAR VISIBILIDAD DE CONTRASEÑA -->
<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const showIcon = document.getElementById('show-icon');
        const hideIcon = document.getElementById('hide-icon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            showIcon.classList.add('hidden');
            hideIcon.classList.remove('hidden');
        } else {
            passwordField.type = 'password';
            showIcon.classList.remove('hidden');
            hideIcon.classList.add('hidden');
        }
    }
</script>

<!-- COMPROBACIÓN DE EMAIL -->
<script>
    document.getElementById("email").addEventListener("blur", function() {
        let email = this.value.trim();
        let allowedDomains = ["alumnos.udg.mx", "alumno.udg.mx"];
        let errorMessage = document.getElementById("error");
    
        if (email.includes("@")) {
            let domain = email.split("@")[1];
            if (!allowedDomains.includes(domain)) {
                errorMessage.classList.remove("hidden");
            } else {
                errorMessage.classList.add("hidden");
            }
        }
        else{
            errorMessage.classList.add("hidden");
        }
    });
</script>
