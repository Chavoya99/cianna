<!-- resources/views/profile/room-configuration.blade.php -->
@section('title')
    {{ 'Configuración de tu habitación' }}
@endsection
@props(['defaultImage' => asset('img/home-add-svgrepo-com.png')])
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>

    <x-validation-errors />
    <!-- CONTENEDOR PRINCIPAL DEL FORMULARIO -->
    <div class="flex w-full justify-center">
        <!-- FORMULARIO -->
        <form class="w-full" id="configRoomForm" action="{{ route('actualizar_informacion_casa') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <!-- TITULO -->
            <div class="relative ml-20 mt-8 w-4/5">
                <h1 class="text-5xl text-cianna-orange">Configuración de la habitación</h1>
            </div>
            <!-- CONTENEDOR HORIZONTAL 1 -->
            <div class="mt-8 flex w-full">
                <!-- CONTENEDOR IZQ (FOTOS 1 Y 2) -->
                <div class="flex w-1/2 flex-wrap">
                    <!-- IMAGEN DEL CUARTO -->
                    <div class="w-1/2 justify-start px-10 sm:justify-start md:justify-start">
                        <div class="flex flex-col items-center py-3">
                            <div class="block flex w-full flex-col items-center">
                                <div id="imgContainerCuarto"
                                    class="mb-2 inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100">
                                    <img id="previewCuarto"
                                        class="h-full w-full rounded-lg border border-cianna-gray object-cover"
                                        src="{{ asset('storage/' . $img_cuarto) }}"
                                        alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_cuarto" type="file"
                                    accept=".png,.jpg,.jpeg"
                                    class="block w-full cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                    onchange="previewImgCuarto(this)">
                            </div>
                            <label for="img_cuarto">Imagen del cuarto (Máx. 4 MB)</label>
                        </div>
                    </div>
                    <!-- IMAGEN DEL BAÑO -->
                    <div class="ml-auto w-1/2 px-10">
                        <div class="flex flex-col items-center py-3">
                            <div class="block flex w-full flex-col items-center">
                                <div id="imgContainerBanio"
                                    class="mb-2 inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100">
                                    <img id="previewBanio"
                                        class="h-full w-full rounded-lg border border-cianna-gray object-cover"
                                        src="{{ asset('storage/' . $img_banio) }}"
                                        alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_banio" type="file"
                                    accept=".png,.jpg,.jpeg"
                                    class="block w-full cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                    onchange="previewImgBanio(this)">
                            </div>
                            <label for="img_banio">Imagen del baño (Máx. 4 MB)</label>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR DERECHO - DATOS -->
                <div class="relative w-1/2 px-20">
                    <!-- DATOS DEL DOMICILIO -->
                    <div class="py-3">
                        <x-custom-label class="flex px-2 text-lg">Domicilio</x-custom-label>
                        <!-- CONTENEDOR SUPERIOR -->
                        <div class="flex flex-wrap">
                            <div class="w-4/6 px-2">
                                <x-custom-label for="calle">Calle</x-custom-label>
                                <x-custom-input id="calle" name="calle" class="w-full"
                                    value="{{ $datosCasa['calle'] }}" required>
                                </x-custom-input>
                            </div>
                            <div class="w-1/6 px-2">
                                <x-custom-label for="num_ext">N° ext.</x-custom-label>
                                <x-custom-input id="num_ext" name="num_ext" class="w-full"
                                    type="number" value="{{ $datosCasa['num_ext'] }}"
                                    min="1" required>
                                </x-custom-input>
                            </div>
                            <div class="w-1/6 px-2">
                                <x-custom-label for="num_int">N° int.</x-custom-label>
                                <x-custom-input id="num_int" name="num_int" class="w-full"
                                    value="{{ $datosCasa['num_int'] }}" min="1"
                                    type="number">
                                </x-custom-input>
                            </div>
                        </div>
                        <!-- CONTENEDOR INFERIOR -->
                        <div class="mt-12 flex flex-wrap">
                            <div class="w-1/5 px-2">
                                <x-custom-label for="cod_post">C.P.</x-custom-label>
                                <x-custom-input id="codigo_postal" name="codigo_postal"
                                    class="w-full" type="number"
                                    value="{{ $datosCasa['codigo_postal'] }}" min="1"
                                    required>
                                </x-custom-input>
                            </div>
                            <div class="w-2/5 px-2">
                                <x-custom-label for="ciudad">Ciudad</x-custom-label>
                                <select id="ciudad" name="ciudad" required
                                    class="mt-1 w-full rounded-md border border-gray-300 text-xs shadow-sm focus:border-cianna-orange focus:ring-cianna-orange">
                                    <option value="gdl"
                                        {{ old('ciudad', $datosCasa['ciudad'] ?? '') == 'gdl' ? 'selected' : '' }}>
                                        Guadalajara
                                    </option>
                                    <option value="salto"
                                        {{ old('ciudad', $datosCasa['ciudad'] ?? '') == 'salto' ? 'selected' : '' }}>
                                        El Salto
                                    </option>
                                    <option value="tlaj_z"
                                        {{ old('ciudad', $datosCasa['ciudad'] ?? '') == 'tlaj_z' ? 'selected' : '' }}>
                                        Tlajomulco de Zúñiga
                                    </option>
                                    <option value="tlaq"
                                        {{ old('ciudad', $datosCasa['ciudad'] ?? '') == 'tlaq' ? 'selected' : '' }}>
                                        Tlaquepaque
                                    </option>
                                    <option value="ton"
                                        {{ old('ciudad', $datosCasa['ciudad'] ?? '') == 'ton' ? 'selected' : '' }}>
                                        Tonalá
                                    </option>
                                    <option value="zap"
                                        {{ old('ciudad', $datosCasa['ciudad'] ?? '') == 'zap' ? 'selected' : '' }}>
                                        Zapopan
                                    </option>
                                </select>
                            </div>
                            <div class="w-2/5 px-2">
                                <x-custom-label for="colonia">Colonia</x-custom-label>
                                <x-custom-input id="colonia" name="colonia" class="w-full"
                                    value="{{ $datosCasa['colonia'] }}" required>
                                </x-custom-input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 2 -->
            <div class="mt-3 flex w-full">
                <!-- CONTENEDOR IZQ (FOTOS 3 Y 4) -->
                <div class="mt-16 flex w-1/2 flex-wrap">
                    <!-- IMAGEN DE LA SALA -->
                    <div class="w-1/2 justify-start px-10 sm:justify-start md:justify-start">
                        <div class="flex flex-col items-center py-3">
                            <div class="block flex w-full flex-col items-center">
                                <div id="imgContainerSala"
                                    class="mb-2 inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100">
                                    <img id="previewSala"
                                        class="h-full w-full rounded-lg border border-cianna-gray object-cover"
                                        src="{{ asset('storage/' . $img_sala) }}"
                                        alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_sala" type="file"
                                    accept=".png,.jpg,.jpeg"
                                    class="block w-full cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                    onchange="previewImgSala(this)">
                            </div>
                            <label for="img_sala">Imagen de la sala (Máx. 4 MB)</label>
                        </div>
                    </div>
                    <!-- IMAGEN DE LA COCINA -->
                    <div class="ml-auto w-1/2 px-10">
                        <div class="flex flex-col items-center py-3">
                            <div class="block flex w-full flex-col items-center">
                                <div id="imgContainerCocina"
                                    class="mb-2 inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100">
                                    <img id="previewCocina"
                                        class="h-full w-full rounded-lg border border-cianna-gray object-cover"
                                        src="{{ asset('storage/' . $img_cocina) }}"
                                        alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_cocina" type="file"
                                    accept=".png,.jpg,.jpeg"
                                    class="block w-full cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                    onchange="previewImgCocina(this)">
                            </div>
                            <label for="img_cocina" class="text-sm">Imagen de la cocina (Máx. 4
                                MB)</label>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR DERECHO - DATOS -->
                <div class="relative w-1/2 px-20">
                    <!-- DESCRIPCION Y REGLAS -->
                    <div>
                        <div class="px-2">
                            <x-custom-label for="desc">Descripcion del lugar</x-custom-label>
                            <div class="relative">
                                <textarea id="desc" name="descripcion" rows="5"
                                    class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-cianna-orange focus:outline-none focus:ring-cianna-orange"
                                    placeholder="Puedes añadir una breve descripción del lugar" maxlength="300" required>{{ $datosCasa['descripcion'] }}</textarea>
                                <div class="absolute bottom-0 right-0 mb-2 mr-5 text-gray-500">
                                    <span id="char-count">300</span> caracteres restantes
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-wrap">
                            <div class="w-1/2 px-2">
                                <x-custom-label for="cod_post">Reglas</x-custom-label>
                                <div
                                    class="mr-12 rounded-md border border-cianna-gray bg-white px-1 py-1">
                                    <x-custom-checkbox id="mascotas" name="reglas[]"
                                        :checked="(is_array(old('reglas')) &&
                                            in_array('acepta_mascotas', old('reglas'))) ||
                                            $datosCasa['acepta_mascotas'] == 'si'" value="mascota"
                                        label="Se aceptan mascotas" />
                                </div>
                                <div
                                    class="mr-12 mt-2 rounded-md border border-cianna-gray bg-white px-1 py-1">
                                    <x-custom-checkbox id="visita" name="reglas[]"
                                        :checked="(is_array(old('reglas')) &&
                                            in_array('visita', old('reglas'))) ||
                                            $datosCasa['acepta_visitas'] == 'si'" value="visita"
                                        label="Se aceptan visitas" />
                                </div>
                                <div
                                    class="mr-12 mt-2 rounded-md border border-cianna-gray bg-white px-1 py-1">
                                    <x-custom-checkbox id="limpieza" name="reglas[]"
                                        :checked="(is_array(old('reglas')) &&
                                            in_array('limpieza', old('reglas'))) ||
                                            $datosCasa['riguroza_limpieza'] == 'si'" value="limpieza"
                                        label="Rigurosa limpieza" />
                                </div>
                            </div>
                            <div class="mt-8 w-1/2 px-2">
                                <div>
                                    <x-custom-input id="regla_adicional" name="regla_adicional"
                                        class="h-8 w-full text-sm"
                                        value="{{ $datosCasa['regla_adicional'] }}"
                                        placeholder="Puedes agregar otra regla"></x-custom-input>
                                </div>
                                <div class="mt-2 flex items-center">
                                    <div class="mr-10">
                                        <x-custom-label>¿Incluye muebles?</x-custom-label>
                                        <div class="flex items-center">
                                            <label class="mr-6">
                                                <input type="radio" name="muebles"
                                                    value="si" id="muebles-s"
                                                    class="h-4 w-4 text-cianna-orange hover:cursor-pointer focus:ring-2 focus:ring-cianna-orange"
                                                    checked
                                                    @if (old('muebles') == 'si' || $datosCasa['muebles'] == 'si') checked @endif>
                                                Sí.
                                            </label>
                                            <label class="">
                                                <input type="radio" name="muebles"
                                                    value="no" id="muebles-n"
                                                    class="h-4 w-4 text-cianna-orange hover:cursor-pointer focus:ring-2 focus:ring-cianna-orange"
                                                    @if (old('muebles') == 'no' || $datosCasa['muebles'] == 'no') checked @endif>
                                                No.
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <x-custom-label>¿Incluye servicios?</x-custom-label>
                                        <div class="flex items-center">
                                            <label class="mr-6">
                                                <input type="radio" name="servicios"
                                                    value="si" id="servicios-s"
                                                    class="h-4 w-4 text-cianna-orange hover:cursor-pointer focus:ring-2 focus:ring-cianna-orange"
                                                    checked
                                                    @if (old('servicios') == 'si' || $datosCasa['servicios'] == 'si') checked @endif>
                                                Sí.
                                            </label>
                                            <label class="">
                                                <input type="radio" name="servicios"
                                                    value="no" id="servicios-n"
                                                    class="h-4 w-4 text-cianna-orange hover:cursor-pointer focus:ring-2 focus:ring-cianna-orange"
                                                    @if (old('servicios') == 'no' || $datosCasa['servicios'] == 'no') checked @endif>
                                                No.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 3 -->
            <div class="mt-3 flex w-full">
                <!-- CONTENEDOR IZQ (FOTOS 5 Y 6) -->
                <div class="flex w-1/2 flex-wrap">
                    <div class="w-1/2 justify-start px-10 sm:justify-start md:justify-start">
                        <!-- IMAGEN DE LA FACHADA -->
                        <div class="flex flex-col items-center py-3">
                            <div class="block flex w-full flex-col items-center">
                                <div id="imgContainerFachada"
                                    class="mb-2 inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100">
                                    <img id="previewFachada"
                                        class="h-full w-full rounded-lg border border-cianna-gray object-cover"
                                        src="{{ asset('storage/' . $img_fachada) }}"
                                        alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_fachada" type="file"
                                    accept=".png,.jpg,.jpeg"
                                    class="block w-full cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                    onchange="previewImgFachada(this)">
                            </div>
                            <label for="img_fachada" class="text-sm">
                                Imagen de la fachada (Máx. 4 MB)
                            </label>
                        </div>
                    </div>
                    <div class="ml-auto w-1/2 px-10">
                        <!-- IMAGEN EXTRA -->
                        <div class="flex flex-col items-center py-3">
                            <div class="block flex w-full flex-col items-center">
                                <div id="imgContainerExtra"
                                    class="mb-2 inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100">
                                    <img id="previewExtra"
                                        class="h-full w-full rounded-lg border border-cianna-gray object-cover"
                                        src="@if ($img_extra != null) {{ asset('storage/' . $img_extra) }} @else {{ $defaultImage }} @endif"
                                        alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_extra" type="file"
                                    accept=".png,.jpg,.jpeg"
                                    class="block w-full cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                    onchange="previewImgExtra(this)">
                            </div>
                            <label for="img_extra">Imagen extra</label>
                            <label class="text-xs">Si lo deseas añade una imagen</label>
                            <label class="text-xs">de cualquier otro lugar de la casa</label>
                            <label class="text-xs">(Máx. 4 MB)</label>
                        </div>
                    </div>
                    <div>
                        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
                        <div class="px-10">
                            <button
                                class="focus:shadow-outline rounded bg-cianna-blue px-4 py-2 font-bold text-white hover:bg-sky-900 focus:outline-none"
                                onclick="window.history.back()">
                                <i class="fa-solid fa-left-long mr-2"></i>Regresar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR DERECHO - DATOS-->
                <div class="relative w-1/2 px-20">
                    <!-- REQUISITOS -->
                    <div class="mt-2">
                        <div class="px-2">
                            <x-custom-label for="reqsts">Requisitos</x-custom-label>
                            <div class="relative">
                                <textarea id="reqsts" name="requisitos" rows="3"
                                    class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-cianna-orange focus:outline-none focus:ring-cianna-orange"
                                    placeholder="Avales, depósitos, comprobantes, etc." maxlength="300" required>{{ $datosCasa['requisitos'] }}</textarea>
                                <div class="absolute bottom-0 right-0 mb-2 mr-5 text-gray-500">
                                    <span id="reqsts-char-count">300</span> caracteres restantes
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PRECIO -->
                    <div class="mt-4">
                        <x-custom-label>Precio (MXN)/MES</x-custom-label>
                        <div class="flex items-center">
                            <span>$</span><x-custom-input id="precio" name="precio"
                                type="number" value="{{ $datosCasa['precio'] }}"
                                class="ml-2 h-8 w-1/4" min="0" max="30000"
                                required></x-custom-input>
                        </div>
                    </div>
                    <!-- COMPROBANTES -->
                    <div class="mt-4">
                        <div class="flex flex-col">
                            <x-custom-label for="compDom1">
                                Comprobante de domicilio 1
                            </x-custom-label>
                            <div class="mt-1 flex">
                                <input id="compDom1" name="compDom1" type="file"
                                    accept="application/pdf"
                                    class="cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange">
                            </div>
                            <label for="compDom1">(Máx. 4 MB)</label>
                        </div>
                        <div class="mt-4 flex flex-col">
                            <x-custom-label for="compDom2">
                                Comprobante de domicilio 2
                            </x-custom-label>
                            <div class="mt-1 flex">
                                <input id="compDom2" name="compDom2" type="file"
                                    accept="application/pdf"
                                    class="cursor-pointer rounded-md border border-cianna-gray bg-cianna-gray text-sm file:cursor-pointer file:bg-cianna-blue file:text-white focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange">
                            </div>
                            <label for="compDom2">(Máx. 4 MB)</label>
                        </div>
                    </div>
                    <div>
                        <button
                            class="focus:shadow-outline mt-6 block w-full rounded bg-cianna-blue px-4 py-2 font-bold text-white hover:bg-sky-950 focus:outline-none"
                            type="submit" onclick="">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-home-layout>

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

        charCount.textContent = maxLength - textarea.value.length;

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

        charCount.textContent = maxLength - textarea.value.length;

        textarea.addEventListener('input', () => {
            const remaining = maxLength - textarea.value.length;
            charCount.textContent = remaining;
        });
    });
    ///////////////////////////////
</script>
