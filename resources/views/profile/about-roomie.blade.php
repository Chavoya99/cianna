<!-- resources/views/profile/about-roomie.blade.php -->
@props(['defaultImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{ 'Ver más | Roomie' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full">
        <!-- TÍTULO -->
        <div class="mt-8 px-20 w-4/5">
            <h1 class="text-cianna-orange text-3xl">Compañero de cuarto</h1>
        </div>
        <!-- CONTENEDOR HORIZONTAL 1 -->
        <div class="flex mt-8 px-20">
            <!-- IMAGEN DEL ROOMIE -->
            <div class="w-1/2">
                <div class="flex flex-col block w-full ml-20 mt-5">
                    <div class="inline-block relative h-[330px] w-[60%] overflow-hidden 
                        rounded-md bg-gray-100">
                        <img class="w-full h-full object-fill border-2 border-cianna-gray 
                        rounded-lg" src={{$defaultImage}} 
                        alt="Imagen previa del roomie" />
                    </div>
                </div>
            </div>
            <!-- INFORMACIÓN DEL ROOMIE -->
            <div class="w-1/2 py-5 flex flex-col">
                <h1 class="font-bold text-3xl line-clamp-1">MARÍA REBOLLAR</h1> <!-- NOMBRE -->
                <p class="mt-2 text-justify text-lg"> <!-- DESCRIPCIÓN -->
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Pellentesque varius vel nibh non venenatis. 
                    Etiam lobortis lobortis dui id pretium. 
                    Sed sed mauris finibus orci aliquet sodales. 
                    Mauris eu erat venenatis, egestas est vitae, auctor turpis. 
                    Interdum et malesuada fames ac ante ipsum primis orci.
                </p>
                <p class="font-bold mt-4 mb-4 text-justify text-xl"> <!-- CARRERA -->
                    Ingeniería informática
                </p>
                <a class="text-cianna-green font-semibold hover:text-cianna-orange" href="">Ver detalles...</a>
                <!-- OCULTAR BOTONES PARA USUARIO TIPO B -->
                <button class="mt-4 w-3/4 bg-cianna-orange hover:bg-orange-300 text-white font-bold py-2 px-4
                    rounded focus:outline-none focus:shadow-outline" 
                    onclick="">
                    <i class="fa-regular fa-star"></i>
                    Agregar a favoritos
                </button>
                <button class="mt-4 w-3/4 bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                    rounded focus:outline-none focus:shadow-outline" 
                    onclick="">
                    <i class="mr-2 fa-solid fa-envelope-open-text"></i>
                    Postularse
                </button>
                <!-- OCULTAR BOTONES PARA USUARIO TIPO B -->
            </div>
        </div>
        <!-- CONTENEDOR HORIZONTAL TITULO 2 -->
        <div class="flex mt-8 px-20 font-bold">
            <p>Lugares que creemos te pueden gustar</p>
        </div>
    </div>
</x-home-layout>