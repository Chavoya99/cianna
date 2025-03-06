<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
@section('title')
    {{ 'Regístrate' }}
@endsection
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <div class="rounded-lg border bg-white px-4 py-2 shadow-lg">
            <div>
                <h1 class="mb-4 border-b-2 pb-4 text-center text-3xl font-bold text-cianna-orange">
                    Crea una cuenta
                </h1>
            </div>

            <form method="POST" action="{{ route('register') }}"
                style="font-family: Arial, sans-serif;">
                @csrf

                <div class="font-sans">
                    <x-custom-input id="name" class="mt-1 block w-full" type="text"
                        name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Nombre" />
                </div>

                <div class="mt-4 font-sans">
                    <x-custom-input id="apellido" class="mt-1 block w-full" type="text"
                        name="apellido" :value="old('apellido')" required autofocus autocomplete="name"
                        placeholder="Apellido" />
                </div>

                <div class="mt-4 font-sans">
                    <x-custom-input id="email" class="mt-1 block w-full" type="email"
                        name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Correo" />
                    <p id="error" class="hidden text-xs text-red-500">El correo que ingresaste
                        no está permitido. Usa tu correo institucional</p>
                </div>

                <div class="relative mt-4 font-sans">
                    <x-custom-input id="password" class="mt-1 block w-full" type="password"
                        name="password" required autocomplete="new-password"
                        placeholder="Contraseña" />
                    <button type="button" onclick="togglePasswordVisibility()"
                        class="absolute inset-y-0 right-0 px-3 py-2 text-gray-500">
                        <!-- Icono para mostrar la contraseña -->
                        <i id="show-icon" class="fas fa-eye"></i>
                        <!-- Icono para ocultar la contraseña -->
                        <i id="hide-icon" class="fas fa-eye-slash hidden"></i>
                    </button>
                </div>

                <div class="relative mt-4 font-sans">
                    <x-custom-input id="password_confirmation" class="mt-1 block w-full"
                        type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Confirmar contraseña" />
                    <button type="button" onclick="togglePasswordConfirmationVisibility()"
                        class="absolute inset-y-0 right-0 px-3 py-2 text-gray-500">
                        <!-- Icono para mostrar la contraseña -->
                        <i id="show-icon-1" class="fas fa-eye"></i>
                        <!-- Icono para ocultar la contraseña -->
                        <i id="hide-icon-1" class="fas fa-eye-slash hidden"></i>
                    </button>
                </div>

                <div class="mt-4">
                    <x-custom-select name="tipo"
                        class="block w-full rounded-md border border-gray-300 px-4 py-2 font-sans text-gray-500 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="A" class="text-gray-500">Ya tengo casa, busco compañeros
                        </option>
                        <option value="B" class="text-gray-500">Busco dónde quedarme</option>
                    </x-custom-select>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' =>
                                            '<a target="_blank" href="' .
                                            route('terms.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Terms of Service') .
                                            '</a>',
                                        'privacy_policy' =>
                                            '<a target="_blank" href="' .
                                            route('policy.show') .
                                            '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                            __('Privacy Policy') .
                                            '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-end font-sans">
                    <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        href="{{ route('login') }}">
                        {{ __('Ya tengo una cuenta') }}
                    </a>

                    <x-button class="ms-4" id="register-button">
                        {{ __('Registrarme') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
<!-- Footer -->
@include('partials.footer')

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

    function togglePasswordConfirmationVisibility() {
        const passwordField = document.getElementById('password_confirmation');
        const showIcon = document.getElementById('show-icon-1');
        const hideIcon = document.getElementById('hide-icon-1');
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
    document.addEventListener("DOMContentLoaded", function() {
        let emailInput = document.getElementById("email");

        emailInput.addEventListener("blur", function() {
            let email = this.value.trim();
            let allowedDomains = ["alumnos.udg.mx", "alumno.udg.mx"];
            let errorMessage = document.getElementById("error");
            let registerButton = document.getElementById("register-button");

            if (email.includes("@")) {
                let domain = email.split("@")[1];
                if (!allowedDomains.includes(domain)) {
                    errorMessage.classList.remove("hidden");
                    registerButton.disabled = true;
                    registerButton.classList.add("opacity-50",
                    "cursor-not-allowed");
                } else {
                    errorMessage.classList.add("hidden");
                    registerButton.disabled = false;
                    registerButton.classList.remove("opacity-50",
                        "cursor-not-allowed");
                }
            } else {
                errorMessage.classList.add(
                "hidden"); // Oculta el mensaje si el input está vacío
                registerButton.disabled = false;
                registerButton.classList.remove("opacity-50", "cursor-not-allowed");
            }
        });
    });
</script>
