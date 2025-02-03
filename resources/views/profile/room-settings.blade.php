<!-- resources/views/profile/room-configuration.blade.php -->
@section('title') {{'Configuración de tu habitación'}} @endsection
@props(['defaultImage' => asset('img/home-add-svgrepo-com.png')])
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>

    <x-validation-errors/>
    <!-- CONTENEDOR PRINCIPAL DEL FORMULARIO -->
    <div class="flex justify-center w-full">
        <!-- FORMULARIO -->
        <form class="w-full" id="configRoomForm" action="{{route('actualizar_informacion_casa')}}" method="POST" 
            enctype="multipart/form-data">
            @csrf
            <!-- TITULO -->
            <div class="relative mt-8 ml-20 w-4/5">
                <h1 class="text-cianna-orange  text-5xl">Configuración de la habitación</h1>
            </div>
            <!-- CONTENEDOR HORIZONTAL 1 -->
            <div class="flex w-full mt-8">
                <!-- CONTENEDOR IZQ (FOTOS 1 Y 2) -->
                <div class="flex flex-wrap w-1/2">
                    <!-- IMAGEN DEL CUARTO -->
                    <div class="justify-start sm:justify-start md:justify-start px-10 w-1/2">
                        <div class="flex flex-col items-center py-3">
                            <div class="flex flex-col items-center block w-full">
                                <div id="imgContainerCuarto" class="inline-block h-40 w-40 
                                    overflow-hidden rounded-md bg-gray-100 mb-2">
                                    <img id="previewCuarto" class="h-full w-full object-cover border 
                                    border-cianna-gray rounded-lg" src="{{asset('storage/'.$img_cuarto)}}" 
                                    alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_cuarto" type="file" accept=".png,.jpg,.jpeg" 
                                class="block w-full file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray
                                border border-cianna-gray focus:border-cianna-orange focus:outline-none 
                                focus:ring-1 focus:ring-cianna-orange"
                                onchange="previewImgCuarto(this)">
                            </div>
                            <label for="img_cuarto">Imagen del cuarto (Máx. 4 MB)</label>
                        </div>
                    </div>
                    <!-- IMAGEN DEL BAÑO -->
                    <div class="ml-auto px-10 w-1/2">
                        <div class="flex flex-col items-center py-3">
                            <div class="flex flex-col items-center block w-full">
                                <div id="imgContainerBanio" class="inline-block h-40 w-40 
                                    overflow-hidden rounded-md bg-gray-100 mb-2">
                                    <img id="previewBanio" class="h-full w-full object-cover border 
                                    border-cianna-gray rounded-lg" src="{{ asset('storage/'.$img_banio) }}" 
                                    alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_banio" type="file" accept=".png,.jpg,.jpeg" 
                                class="block w-full file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray 
                                border border-cianna-gray focus:border-cianna-orange focus:outline-none 
                                focus:ring-1 focus:ring-cianna-orange"
                                onchange="previewImgBanio(this)">
                            </div>
                            <label for="img_banio">Imagen del baño (Máx. 4 MB)</label>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR DERECHO - DATOS -->
                <div class="relative px-20 w-1/2">
                    <!-- DATOS DEL DOMICILIO -->
                    <div class="py-3">
                        <x-custom-label class=" flex text-lg px-2">Domicilio</x-custom-label>
                        <!-- CONTENEDOR SUPERIOR -->
                        <div class="flex flex-wrap">
                            <div class="w-4/6 px-2">
                                <x-custom-label for="calle">Calle</x-custom-label>
                                <x-custom-input id="calle" name="calle" class="w-full" 
                                    value="{{$datosCasa['calle']}}" required>
                                </x-custom-input>
                            </div>
                            <div class="w-1/6 px-2">
                                <x-custom-label for="num_ext">N° ext.</x-custom-label>
                                <x-custom-input id="num_ext" name="num_ext" class="w-full"
                                    type="number" value="{{$datosCasa['num_ext']}}" min="1" required>
                                </x-custom-input>
                            </div>
                            <div class="w-1/6 px-2">
                                <x-custom-label for="num_int">N° int.</x-custom-label>
                                <x-custom-input id="num_int" name="num_int" class="w-full" 
                                    value="{{$datosCasa['num_int']}}" min="1" type="number">
                                </x-custom-input>
                            </div>
                        </div>
                        <!-- CONTENEDOR INFERIOR -->
                        <div class="flex flex-wrap mt-12">
                            <div class="w-1/5 px-2">
                                <x-custom-label for="cod_post">C.P.</x-custom-label>
                                <x-custom-input id="codigo_postal" name="codigo_postal" class="w-full" 
                                    type="number" value="{{$datosCasa['codigo_postal']}}" min="1" required>
                                </x-custom-input>
                            </div>
                            <div class="w-2/5 px-2">
                                <x-custom-label for="ciudad">Ciudad</x-custom-label>
                                <x-custom-input id="ciudad" name="ciudad" class="w-full" 
                                    value="{{$datosCasa['ciudad']}}" required>
                                </x-custom-input>
                            </div>
                            <div class="w-2/5 px-2">
                                <x-custom-label for="colonia">Colonia</x-custom-label>
                                <x-custom-input id="colonia" name="colonia" class="w-full" 
                                    value="{{$datosCasa['colonia']}}" required>
                                </x-custom-input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTENEDOR HORIZONTAL 2 -->
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ (FOTOS 3 Y 4) -->
                <div class="flex flex-wrap w-1/2 mt-16">
                    <!-- IMAGEN DE LA SALA -->
                    <div class="justify-start sm:justify-start md:justify-start px-10 w-1/2">
                        <div class="flex flex-col items-center py-3">
                            <div class="flex flex-col items-center block w-full">
                                <div id="imgContainerSala" class="inline-block h-40 w-40 
                                    overflow-hidden rounded-md bg-gray-100 mb-2">
                                    <img id="previewSala" class="h-full w-full object-cover border 
                                    border-cianna-gray rounded-lg" src="{{ asset('storage/'.$img_sala)}}" 
                                    alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_sala" type="file" accept=".png,.jpg,.jpeg" 
                                class="block w-full file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer 
                                bg-cianna-gray border border-cianna-gray focus:border-cianna-orange 
                                focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                onchange="previewImgSala(this)">
                            </div>
                            <label for="img_sala">Imagen de la sala (Máx. 4 MB)</label>
                        </div>
                    </div>
                    <!-- IMAGEN DE LA COCINA -->
                    <div class="ml-auto px-10 w-1/2">
                        <div class="flex flex-col items-center py-3">
                            <div class="flex flex-col items-center block w-full">
                                <div id="imgContainerCocina" class="inline-block h-40 w-40 
                                overflow-hidden rounded-md bg-gray-100 mb-2">
                                    <img id="previewCocina" class="h-full w-full object-cover border 
                                    border-cianna-gray rounded-lg" src="{{ asset('storage/'.$img_cocina) }}" 
                                    alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_cocina" type="file" accept=".png,.jpg,.jpeg" 
                                class="block w-full file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray 
                                border border-cianna-gray focus:border-cianna-orange 
                                focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                onchange="previewImgCocina(this)">
                            </div>
                            <label for="img_cocina" class="text-sm">Imagen de la cocina (Máx. 4 MB)</label>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR DERECHO - DATOS -->
                <div class="relative px-20 w-1/2">
                    <!-- DESCRIPCION Y REGLAS -->
                    <div>
                        <div class="px-2">
                            <x-custom-label for="desc">Descripcion del lugar</x-custom-label>
                            <div class="relative">
                                <textarea id="desc" name="descripcion" rows="5" class="w-full px-4 py-2 
                                border border-gray-300 rounded-md shadow-sm focus:outline-none 
                                focus:border-cianna-orange focus:ring-cianna-orange" 
                                placeholder="Puedes añadir una breve descripción del lugar" 
                                maxlength="300" 
                                required >{{$datosCasa['descripcion']}}</textarea>
                            <div class="absolute bottom-0 right-0 mb-2 mr-5 text-gray-500">
                            <span id="char-count">300</span> caracteres restantes
                        </div>
                    </div>
                    </div>
                        <div class="flex flex-wrap mt-4">
                            <div class="w-1/2 px-2">
                                <x-custom-label for="cod_post">Reglas</x-custom-label>
                                <div class="bg-white rounded-md px-1 py-1 border border-cianna-gray mr-12">
                                    <x-custom-checkbox id="mascotas" name="reglas[]" 
                                    :checked="is_array(old('reglas')) && in_array('acepta_mascotas', old('reglas')) || $datosCasa['acepta_mascotas'] == 'si'"
                                    value="mascota" label="Se aceptan mascotas"/>
                                </div>
                                <div class="mt-2 bg-white rounded-md px-1 py-1 border border-cianna-gray mr-12">
                                    <x-custom-checkbox id="visita" name="reglas[]" 
                                    :checked="is_array(old('reglas')) && in_array('visita', old('reglas')) || $datosCasa['acepta_visitas'] == 'si'" 
                                    value="visita" label="Se aceptan visitas"/>
                                </div>
                                <div class="mt-2 bg-white rounded-md px-1 py-1 border border-cianna-gray mr-12">
                                    <x-custom-checkbox id="limpieza" name="reglas[]" 
                                    :checked="is_array(old('reglas')) && in_array('limpieza', old('reglas')) || $datosCasa['riguroza_limpieza'] == 'si'" 
                                    value="limpieza" label="Rigurosa limpieza"/>
                                </div>
                            </div>
                            <div class="w-1/2 px-2 mt-8">
                                <div>
                                    <x-custom-input id="regla_adicional" name="regla_adicional" 
                                    class="w-full h-8 text-sm" value="{{$datosCasa['regla_adicional']}}" 
                                    placeholder="Puedes agregar otra regla"></x-custom-input>
                                </div>
                                <div class="flex items-center mt-2">
                                    <div class="mr-10">
                                        <x-custom-label>¿Incluye muebles?</x-custom-label>
                                        <div class="flex items-center">
                                            <label class="mr-6">
                                                <input type="radio" name="muebles" value="si" 
                                                id="muebles-s" class="w-4 h-4 text-cianna-orange 
                                                focus:ring-cianna-orange focus:ring-2 
                                                hover:cursor-pointer" checked 
                                                @if(old('muebles') == 'si' || $datosCasa['muebles'] == 'si') checked @endif >
                                                Sí.
                                            </label>
                                            <label class="">
                                                <input type="radio" name="muebles" value="no" 
                                                id="muebles-n" class="w-4 h-4 text-cianna-orange 
                                                focus:ring-cianna-orange focus:ring-2 
                                                hover:cursor-pointer" 
                                                @if(old('muebles') == 'no' || $datosCasa['muebles'] == 'no') checked @endif>
                                                No.
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <x-custom-label>¿Incluye servicios?</x-custom-label>
                                        <div class="flex items-center">
                                            <label class="mr-6">
                                                <input type="radio" name="servicios" value="si" 
                                                id="servicios-s" class="w-4 h-4 text-cianna-orange 
                                                focus:ring-cianna-orange focus:ring-2 
                                                hover:cursor-pointer" checked 
                                                @if(old('servicios') == 'si' || $datosCasa['servicios'] == 'si') checked @endif >
                                                Sí.
                                            </label>
                                            <label class="">
                                                <input type="radio" name="servicios" value="no" 
                                                id="servicios-n" class="w-4 h-4 text-cianna-orange 
                                                focus:ring-cianna-orange focus:ring-2 
                                                hover:cursor-pointer" 
                                                @if(old('servicios') == 'no' || $datosCasa['servicios'] == 'no') checked @endif>
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
            <div class="flex w-full mt-3">
                <!-- CONTENEDOR IZQ (FOTOS 5 Y 6) -->
                <div class="flex flex-wrap w-1/2">
                    <div class="justify-start sm:justify-start md:justify-start px-10 w-1/2">
                        <!-- IMAGEN DE LA FACHADA -->
                        <div class="flex flex-col items-center py-3">
                            <div class="flex flex-col items-center block w-full">
                                <div id="imgContainerFachada" class="inline-block h-40 w-40 
                                    overflow-hidden rounded-md bg-gray-100 mb-2">
                                    <img id="previewFachada" class="h-full w-full object-cover 
                                    border border-cianna-gray rounded-lg" src="{{ asset('storage/'.$img_fachada) }}" 
                                    alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_fachada" type="file" accept=".png,.jpg,.jpeg" 
                                class="block w-full file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray 
                                border border-cianna-gray focus:border-cianna-orange 
                                focus:outline-none focus:ring-1 focus:ring-cianna-orange"
                                onchange="previewImgFachada(this)">
                            </div>
                            <label for="img_fachada" class="text-sm">
                                Imagen de la fachada (Máx. 4 MB)
                            </label>
                        </div>
                    </div>
                    <div class="ml-auto px-10 w-1/2">
                        <!-- IMAGEN EXTRA -->
                        <div class="flex flex-col items-center py-3">
                            <div class="flex flex-col items-center block w-full">
                                <div id="imgContainerExtra" class="inline-block h-40 w-40 
                                    overflow-hidden rounded-md bg-gray-100 mb-2">
                                    <img id="previewExtra" class="h-full w-full object-cover border 
                                    border-cianna-gray rounded-lg" src="@if($img_extra != null) {{ asset('storage/'.$img_extra)}} @else {{$defaultImage}} @endif" 
                                    alt="Imagen previa" />
                                </div>
                                <p class="text-center text-xs font-bold">
                                    Imagen actual
                                </p>
                                <input id="" name="img_extra" type="file" accept=".png,.jpg,.jpeg" 
                                class="block w-full file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray 
                                border border-cianna-gray focus:border-cianna-orange 
                                focus:outline-none focus:ring-1 focus:ring-cianna-orange" 
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
                            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                                rounded focus:outline-none focus:shadow-outline" 
                                onclick="window.history.back()">
                                <i class="fa-solid fa-left-long mr-2"></i>Regresar
                            </button>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR DERECHO - DATOS-->
                <div class="relative px-20 w-1/2">
                    <!-- REQUISITOS -->
                    <div class="mt-2">
                        <div class="px-2">
                            <x-custom-label for="reqsts">Requisitos</x-custom-label>
                            <div class="relative">
                                <textarea id="reqsts" name="requisitos" rows="3" class="w-full px-4 py-2
                                border border-gray-300 rounded-md shadow-sm focus:outline-none 
                                focus:border-cianna-orange focus:ring-cianna-orange" 
                                placeholder="Avales, depósitos, comprobantes, etc." maxlength="300" 
                                required >{{$datosCasa['requisitos']}}</textarea>
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
                            <span>$</span><x-custom-input id="precio" name="precio" type="number" 
                            value="{{$datosCasa['precio']}}" class="ml-2 w-1/4 h-8" min="0"  
                            max="30000" required></x-custom-input>
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
                                accept="application/pdf" class="file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray
                                border border-cianna-gray focus:border-cianna-orange 
                                focus:outline-none focus:ring-1 focus:ring-cianna-orange">
                            </div>
                            <label for="compDom1">(Máx. 4 MB)</label>
                        </div>
                        <div class="flex flex-col mt-4">
                            <x-custom-label for="compDom2">
                                Comprobante de domicilio 2
                            </x-custom-label>
                            <div class="mt-1 flex">
                                <input id="compDom2" name="compDom2" type="file" 
                                accept="application/pdf" class="file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray 
                                border border-cianna-gray focus:border-cianna-orange 
                                focus:outline-none focus:ring-1 focus:ring-cianna-orange">
                            </div>
                            <label for="compDom2">(Máx. 4 MB)</label>
                        </div>
                    </div>
                    <div>
                        <button class="mt-6 block w-full bg-cianna-blue hover:bg-sky-950 text-white 
                            font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
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