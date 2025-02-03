<div>
    <div class="mt-8 px-16 grid grid-cols-2 gap-6">
        @foreach ($postulaciones as $postulacion)
            <div class="flex flex-col py-3 px-3 rounded-lg">
                <!-- CONTENEDOR DE IMAGEN Y ENLACES -->
                <div class="inline-block w-full overflow-hidden flex relative 
                    transition-transform transform hover:scale-105">
                    <!-- IMAGEN -->
                    <a href="{{route('detalles_roomie', $postulacion)}}" class="w-1/2">
                        <img class="object-cover w-full h-full border border-cianna-gray rounded-md" 
                            src="{{ asset('storage/'. $postulacion->user->archivos->first()->ruta_archivo) }}"
                            alt="Imagen previa del roomie" />
                    </a>
                    <!-- ENLACES -->
                    <div class="flex flex-col justify-center px-3 py-3 w-1/2">
                        <!-- NOMBRE -->
                        <a href="{{route('detalles_roomie', $postulacion)}}" 
                            class="text-lg font-semibold line-clamp-1">
                            {{$postulacion->user->name.' '.$postulacion->user->apellido}}
                        </a>
                        <!-- CARRERA -->
                        <a href="{{route('detalles_roomie', $postulacion)}}" 
                        class="text-sm text-justify line-clamp-1 mt-1 text-cianna-green font-semibold">
                            {{$carreras[$postulacion->carrera]}}
                        </a>
                        <!-- EDAD -->
                        <a href="{{route('detalles_roomie', $postulacion)}}" 
                            class="text-sm text-justify line-clamp-1 mt-1 text-gray-600 font-semibold">
                            {{$postulacion->edad}} años de edad
                        </a>
                        <!-- DESCRIPCIÓN -->
                        <a href="{{route('detalles_roomie', $postulacion)}}" 
                            class="text-sm text-justify line-clamp-3 mt-1">
                            {{$postulacion->descripcion}}
                        </a>
                        <!-- ESTADO POSTULACIÓN -->
                        <div class="mt-2">
                            <!-- FECHA DE POSTULACIÓN -->
                            <div class="flex">
                                <p class="font-bold mr-1">Recibido: </p>
                                {{ ucfirst(\Carbon\Carbon::parse($postulacion->pivot->fecha)->translatedFormat('d [\de ]M [\de ] Y')) }}
                            </div>
                            @php
                                $estado_postulacion = $postulacion->pivot->estado;
                            @endphp
                            @if ($estado_postulacion == "pendiente")
                                <div class="flex">
                                    <p class="font-bold">Estado:</p>
                                    <p class="ml-1 text-yellow-600 font-bold">Pendiente</p>
                                </div>
                                <div>
                                    <form action="{{route('aceptar_postulacion', $postulacion)}}" method="POST">
                                        @csrf
                                        <button class="px-2 py-1 mt-2 border rounded bg-cianna-green
                                            text-white font-bold hover:bg-lime-600" type="submit">
                                            <i class="fa-solid fa-circle-check mr-1"></i>Aceptar
                                        </button>
                                    </form>
                                </div>
                            @elseif($estado_postulacion == "aceptada")
                                <div class="flex">
                                    <p class="font-bold">Estado:</p>
                                    <p class="ml-1 text-cianna-green font-bold">Aceptada</p>
                                </div>
                                <form action="{{route('ver_chat', $postulacion)}}" method="POST">
                                    @csrf
                                    <button class="px-2 py-1 mt-2 border rounded bg-cianna-blue 
                                        text-white font-bold hover:bg-sky-900" 
                                        type="submit">
                                        <i class="fa-solid fa-message mr-1"></i>Chat
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Paginación -->
    @if($postulaciones->hasPages())
    <div class="mt-8 px-20">
        {{ $postulaciones->links() }}
    </div>
    @endif
</div>