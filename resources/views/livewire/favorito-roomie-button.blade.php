<div>
    @if (!$isFavorited)
        <button class="mt-4 w-3/4 bg-cianna-orange hover:bg-orange-300 text-white font-bold py-2 px-4
            rounded focus:outline-none focus:shadow-outline"
            wire:click="favorito">
            <i class="fa-regular fa-star"></i>
            Agregar a favoritos
        </button>
    @else
        <button class="mt-4 w-3/4 bg-cianna-blue hover:bg-gray-600 text-white font-bold py-2 px-4
            rounded focus:outline-none focus:shadow-outline"
            wire:click="favorito">
            <i class="fa fa-star"></i>
            Quitar de favoritos
        </button>
    @endif
    
</div>
