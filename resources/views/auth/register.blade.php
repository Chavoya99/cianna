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
