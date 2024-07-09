<!-- resources/views/home.blade.php -->
@props(['defaultHomeImage' => asset('img/home-add-svgrepo-com.png'), 'defaultProfileImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{'Inicio'}} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un hogar?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
            @foreach ($casas as $casa)
                <?php 
                    $imagen = $casa->archivos()->where('clasificacion_archivo', 'img_fachada')->first();
                ?>
                
                <!-- IMAGEN CASA-->
                <div class="w-1/4 flex flex-col py-3 pr-3">
                    <div class="flex flex-col block">
                        <div class="inline-block h-44 w-full overflow-hidden rounded-md bg-gray-100 relative">
                            <a href="detalle-home-1"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                            src="{{'storage/'. $imagen->ruta_archivo}}" alt="Imagen previa del hogar" /></a>
                        </div>
                    </div>
                    <!-- COLONIA -->
                    <a href="detalle-home-1" class="mt-2 text-lg font-semibold line-clamp-1">{{$casa->colonia}}</a>
                    <!-- DESCRIPCIÓN -->
                    <a href="detalle-home-1" class="text-sm line-clamp-3">{{$casa->descripcion}}</a>
                </div>
            @endforeach
            
        </div>
        <div class="text-right mr-20 mt-2"><a class="text-cianna-green font-semibold hover:text-cianna-orange" href="see-homes">Ver más...</a></div>
    </div>
    <!-- ROOMIES -->
    <div class="w-full">
        <div class="font-bold text-3xl mt-8 ml-16 mr-16">¿Buscas un compañero de cuarto?</div>
        <div class="mt-2 ml-16">Lo recomendado para ti</div>
        <div class="flex justify-between mt-2 ml-16 mr-16 overflow-hidden">
            @foreach ($roomies as $roomie)
                <!-- IMAGEN ROOMMIE-->
                <?php 
                    $imagen = $roomie->user->archivos()->where('archivo_type', 'img_perf')->first();
                ?>
                <div class="w-1/6 flex flex-col py-3 pr-3">
                    <div class="flex flex-col block">
                        <div class="inline-block h-36 w-full overflow-hidden rounded-md bg-gray-100 relative">
                            <a href="detalle-roommie-1"><img class="object-cover w-full h-full absolute top-0 left-0 border border-cianna-gray rounded-lg" 
                            src="{{'storage/'. $imagen->ruta_archivo }}" alt="Imagen previa del hogar" /></a>
                        </div>
                    </div>
                    <!-- NOMBRE ROOMIE -->
                    <a href="detalle-roommie-1" class="mt-2 text-lg font-semibold line-clamp-1">{{$roomie->user->name}} </a>
                    <!-- DESCRIPCIÓN ROOMIE -->
                    <a href="detalle-roommie-1" class="text-sm line-clamp-3">{{$roomie->descripcion}}</a>
                </div>
            @endforeach
            
            
        </div>
        <div class="text-right mr-20 mt-2"><a class="text-cianna-green font-semibold hover:text-cianna-orange" href="see-rommies">Ver más...</a></div>
    </div>
</x-home-layout>
