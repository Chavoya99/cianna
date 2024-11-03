<!-- boton de la vista about-room.blade.php -->
<div>
    @if(!$isFavorited)
        <button class="mt-4 w-1/2 bg-cianna-orange hover:bg-orange-300 text-white font-bold 
            py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            wire:click="favorito">
            <i class="fa-solid fa-heart-circle-plus mr-2"></i>
            Agregar a favoritos
        </button>
    @else
        <button class="mt-4 w-1/2 bg-gray-600 hover:bg-gray-400 text-white font-bold py-2 px-4
            rounded focus:outline-none focus:shadow-outline" 
            wire:click="favorito">
            <i class="fa-solid fa-heart-circle-minus"></i>
            Quitar de favoritos
        </button>
    @endif
    

</div>
