<!-- resources/views/config-hogar.blade.php -->
@section('title') {{'Configuración del hogar'}} @endsection
<x-guest-layout>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">¡Algo salió mal!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-config-hogar-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>
        <!-- CONTENEDOR PRINCIPAL DEL FORMULARIO -->
        <div class="flex justify-center w-full">
            <!-- FORMULARIO -->
            <form class="w-full" id="configHomeForm" action="{{route('guardar_hogar')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- TITULO -->
                <div class="relative px-20 bg-cianna-white w-4/5">
                    <h1 class="text-cianna-orange text-6xl">Configuración del hogar</h1>
                </div>

                <!-- CONTENEDOR HORIZONTAL 1 -->
                <div class="flex w-full mt-8">
                    <!-- CONTENEDOR IZQ (FOTOS 1 Y 2) -->
                    <div class="flex flex-wrap w-1/2">
                        <div class="justify-start sm:justify-start md:justify-start px-10 w-1/2">
                            <x-foto-cuarto/>
                        </div>
                        <div class="ml-auto px-10 w-1/2">
                            <x-foto-banio/>
                        </div>
                    </div>
                    <!-- CONTENEDOR DER -->
                    <div class="relative px-20 w-1/2">
                        <x-datos-hogar/>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 2 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ (FOTOS 3 Y 4) -->
                    <div class="flex flex-wrap w-1/2 mt-16">
                        <div class="justify-start sm:justify-start md:justify-start px-10 w-1/2">
                            <x-foto-sala/>
                        </div>
                        <div class="ml-auto px-10 w-1/2">
                            <x-foto-cocina/>
                        </div>
                    </div>
                    <!-- CONTENEDOR DER -->
                    <div class="relative px-20 w-1/2">
                        <x-descripcion-reglas/>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 3 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ (FOTOS 5 Y 6) -->
                    <div class="flex flex-wrap w-1/2">
                        <div class="justify-start sm:justify-start md:justify-start px-10 w-1/2">
                            <x-foto-fachada/>
                        </div>
                        <div class="ml-auto px-10 w-1/2">
                            <x-foto-extra/>
                        </div>
                    </div>
                    <!-- CONTENEDOR DER -->
                    <div class="relative px-20 w-1/2 mb-8">
                        <x-requisitos-precio-comprobante/>
                        <button class="mt-6 block w-full bg-cianna-blue hover:bg-sky-950 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" onclick="">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-config-hogar-card>
</x-guest-layout>
<!-- Footer -->
@include('partials.footer')

<script>
    // PREVIWE IMAGEN CUARTO
    function previewImgCuarto(input) {
        var preview = document.getElementById('previewCuarto');
        var imageContainer = document.getElementById('imgContainerCuarto');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imageContainer.style.display = 'block'; // Mostrar el contenedor de imagen
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            imageContainer.style.display = 'none'; // Ocultar el contenedor de imagen
        }
    }

    //PREVIEW IMAGEN BAÑO
    function previewImgBanio(input) {
        var preview = document.getElementById('previewBanio');
        var imageContainer = document.getElementById('imgContainerBanio');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imageContainer.style.display = 'block'; // Mostrar el contenedor de imagen
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            imageContainer.style.display = 'none'; // Ocultar el contenedor de imagen
        }
    }

    //PREVIEW IMAGEN SALA
    function previewImgSala(input) {
        var preview = document.getElementById('previewSala');
        var imageContainer = document.getElementById('imgContainerSala');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imageContainer.style.display = 'block'; // Mostrar el contenedor de imagen
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            imageContainer.style.display = 'none'; // Ocultar el contenedor de imagen
        }
    }

    //PREVIEW IMAGEN COCINA
    function previewImgCocina(input) {
        var preview = document.getElementById('previewCocina');
        var imageContainer = document.getElementById('imgContainerCocina');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imageContainer.style.display = 'block'; // Mostrar el contenedor de imagen
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            imageContainer.style.display = 'none'; // Ocultar el contenedor de imagen
        }
    }

    //PREVIEW IMAGEN FACHADA
    function previewImgFachada(input) {
        var preview = document.getElementById('previewFachada');
        var imageContainer = document.getElementById('imgContainerFachada');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imageContainer.style.display = 'block'; // Mostrar el contenedor de imagen
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            imageContainer.style.display = 'none'; // Ocultar el contenedor de imagen
        }
    }

    //PREVIEW IMAGEN EXTRA
    function previewImgExtra(input) {
        var preview = document.getElementById('previewExtra');
        var imageContainer = document.getElementById('imgContainerExtra');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imageContainer.style.display = 'block'; // Mostrar el contenedor de imagen
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            imageContainer.style.display = 'none'; // Ocultar el contenedor de imagen
        }
    }

    // PARA CONTAR LOS CARACTERES EN LA DESCRIPCION
    document.addEventListener('DOMContentLoaded', (event) => {
        const textarea = document.getElementById('desc');
        const charCount = document.getElementById('char-count');
        const maxLength = textarea.getAttribute('maxlength');

        textarea.addEventListener('input', () => {
            const remaining = maxLength - textarea.value.length;
            charCount.textContent = remaining;
        });
    });
    ///////////////////////////////

    // PARA CONTAR LOS CARACTERES EN REQUISITOS
    document.addEventListener('DOMContentLoaded', (event) => {
        const textarea = document.getElementById('reqsts');
        const charCount = document.getElementById('reqsts-char-count');
        const maxLength = textarea.getAttribute('maxlength');

        textarea.addEventListener('input', () => {
            const remaining = maxLength - textarea.value.length;
            charCount.textContent = remaining;
        });
    });
    ///////////////////////////////
</script>