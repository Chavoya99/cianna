@props(['defaultProfileImage' => asset('img/avatar-default-svgrepo-com.png')])
<div class="w-full flex items-center justify-between bg-white px-20 py-3">
    <div>
        <?php 
            if(Illuminate\Support\Facades\Auth::user()->tipo == 'A'){
                $ruta_home=route('homeA');
            }else if(Illuminate\Support\Facades\Auth::user()->tipo == 'B'){
                $ruta_home = route('homeB');
            }else{
                $ruta_home = route('dashboard');
            } 
        ?>
        <a href="{{$ruta_home}}" class="text-cianna-orange font-bold hover:text-orange-700">
            INICIO
        </a>
    </div>
    <!-- PREFERENCIAS DE BÚSQUEDA Y BOTÓN BUSCAR -->
    <x-search-preferences></x-search-preferences>
    <!-- DROPDOWN USUARIO -->
    <div class="relative" id="dropDownButton">
        <div class="flex items-center cursor-pointer" onclick="toggleDropDown()">
            @if (Auth::check())
                <?php

                $imagen = Auth::user()->archivos()->where('archivo_type', 'img_perf')->get();
                ?>
                {{Auth::user()->name}}
                <img class="h-8 w-8 rounded-full border border-cianna-gray ml-2 mr-2" 
                src="{{asset('storage/'. $imagen[0]->ruta_archivo)}}" alt="Foto de perfil">
                <i id="dropDownIcon" class="fa-solid fa-chevron-down text-cianna-gray"></i>
            @else
                Invitado
                <img class="h-8 w-8 rounded-full border border-cianna-gray ml-2 mr-2" 
                src="{{$defaultProfileImage}}" alt="Foto de perfil">
                <i id="dropDownIcon" class="fa-solid fa-chevron-down text-cianna-gray"></i>
            @endif
        </div>
        <div id="dropDown" class="absolute right-0 mt-2 w-48 bg-white bg-opacity-75 
            border-cianna-gray border-[1px] shadow-md py-2 px-2 rounded-md hidden z-10 
            transition-all duration-300 transform -translate-y-full opacity-0">
            <!-- SOLO MOSTRAR SI NO SE HA INICIADO SESIÓN -->
            @if(!Auth::check())
                <a href="login">
                    <div class="flex bg-cianna-gray items-center px-1 py-1 rounded-md w-full 
                        hover:bg-cianna-orange cursor-pointer">
                        <i class="fa-solid fa-door-open ml-2 mr-2"></i>Iniciar sesión
                    </div>
                </a>
            @else
                <a href="{{route('mi_perfil')}}">
                    <div class="mt-1 flex bg-cianna-gray items-center px-1 py-1 
                        rounded-md w-full hover:bg-cianna-orange cursor-pointer">
                        <i class="fa-solid fa-user ml-2 mr-2"></i>Perfil
                    </div>
                </a>
                <a href="{{route('config_cuenta')}}">
                    <div class="mt-1 flex bg-cianna-gray items-center px-1 py-1 
                        rounded-md w-full hover:bg-cianna-orange cursor-pointer">
                        <i class="fa-solid fa-gear ml-2 mr-2"></i>Configuración
                    </div>
                </a>
                <!-- SOLO MOSTRAR SI YA SE HA INICIADO SESIÓN -->
                <div class="mt-1 flex bg-cianna-gray items-center px-1 py-1 rounded-md w-full 
                    hover:bg-cianna-orange cursor-pointer">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            <i class="fa-solid fa-door-closed ml-2 mr-2"></i>{{ __('Cerrar sesión') }}
                        </a>
                    </form>
                </div>
            @endif
            
        </div>
    </div>
</div>

<script>
    function toggleDropDown(){
        let dropDown = document.getElementById('dropDown');
        let dropDownIcon = document.getElementById('dropDownIcon');
        if (dropDown.classList.contains('hidden')) {
            dropDown.classList.remove('hidden');
            setTimeout(() => {
                dropDown.classList.remove('opacity-0', '-translate-y-full');
                dropDown.classList.add('opacity-100', 'translate-y-0');
                dropDownIcon.classList.remove('fa-chevron-down');
                dropDownIcon.classList.add('fa-chevron-up');
            }, 10);
        } else {
            dropDown.classList.add('opacity-0', '-translate-y-full');
            dropDown.classList.remove('opacity-100', 'translate-y-0');
            dropDownIcon.classList.remove('fa-chevron-up');
            dropDownIcon.classList.add('fa-chevron-down');
            setTimeout(() => {
                dropDown.classList.add('hidden');
            }, 300);
        }
    }


    // Cerrar el dropdown al hacer clic fuera de él
    document.addEventListener('click', (event) => {
        let dropDown = document.getElementById('dropDown');
        let dropDownButton = document.getElementById('dropDownButton');
        let dropDownIcon = document.getElementById('dropDownIcon');
        if (!dropDownButton.contains(event.target) && !dropDown.contains(event.target)) {
            dropDown.classList.add('opacity-0', '-translate-y-full');
            dropDown.classList.remove('opacity-100', 'translate-y-0');
            dropDownIcon.classList.remove('fa-chevron-up');
            dropDownIcon.classList.add('fa-chevron-down');
            setTimeout(() => {
                dropDown.classList.add('hidden');
            }, 300);
        }
    });
</script>

<style>
    /* Añadir transiciones suaves a la propiedad transform */
    .transition-transform {
        transition: transform 0.3s ease-in-out;
    }
</style>

