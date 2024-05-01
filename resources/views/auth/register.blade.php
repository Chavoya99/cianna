

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo" >
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div>
            <h1 style="font-size: 96px; text-align: center; color: #D47814;">Registro</h1>
        </div>

        <form method="POST" action="{{ route('register') }}" style="font-family: Arial, sans-serif;">
            @csrf

            <div>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nombre" />
            </div>

            <div class="mt-4">
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Correo" />
            </div>

            <div class="mt-4 relative">
                <x-input id="password" class="block mt-1 w-full pr-12" type="password" name="password" required autocomplete="new-password" placeholder="Contraseña" />
                <button id="togglePassword" type="button" class="absolute right-0 top-1/2 transform -translate-y-1/2 mr-3 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-2-2a1 1 0 100-2 1 1 0 000 2zm-1 6a5.001 5.001 0 00-3.89 1.916L4 18.329V20a2 2 0 002 2h12a2 2 0 002-2v-1.671l-3.109-3.413A5.001 5.001 0 0012 16z" />
                    </svg>
                </button>
            </div>

            <div class="mt-4">
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña" />
            </div>

            <div class="mt-4">
                <select class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    <option value="A">Estoy buscando dónde quedarme</option>
                    <option value="B">Ya tengo casa</option>
                    <option value="Admin">Admin (Solo personal autorizado XD)</option>
                </select>  
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Ya tengo una cuenta') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Registrarme') }}
                </x-button>
            </div>
        </form>
        
    </x-authentication-card>
    <footer class="text-gray-600 bg-gray-300 py-10 font-bold flex justify-between">
        <div>
            © {{ date('Y') }} Cianna. Todos los derechos reservados.
        </div>
        <div>
            <a href="https://facebook.com/cianna" class="hover:text-blue-700 mx-2">Facebook</a>
            <a href="https://twitter.com/cianna" class="hover:text-blue-700 mx-2">Twitter</a>
            <a href="https://instagram.com/cianna" class="hover:text-blue-700 mx-2">Instagram</a>
            <a href="https://linkedin.com/cianna" class="hover:text-blue-700 mx-2">LinkedIn</a>
            <a href="https://youtube.com/cianna" class="hover:text-blue-700 mx-2">YouTube</a>
        </div>
    </footer>
</x-guest-layout>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        passwordConfirmationInput.setAttribute('type', type);
        
        // Cambiar el icono al hacer clic
        const svgIcon = this.querySelector('svg');
        if (svgIcon.classList.contains('fa-eye')) {
            svgIcon.classList.remove('fa-eye');
            svgIcon.classList.add('fa-eye-slash');
        } else {
            svgIcon.classList.remove('fa-eye-slash');
            svgIcon.classList.add('fa-eye');
        }
    });
</script>
