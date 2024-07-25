<!-- resources/views/components/medical-conditions.blade.php -->
<x-custom-label for="padecimiento">
    ¿Tienes algún padecimiento médico?
</x-custom-label>
<div class="flex items-center flex-wrap">
    <div class="mr-12">
        <div class="flex items-center">
            <label class="mr-8">
                <input type="radio" name="padecimiento" value="si" id="padecimiento-si" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('padecimiento')== 'si') checked @endif>
                    Sí
            </label>
            <label>
                <input type="radio" name="padecimiento" value="no" id="padecimiento-no" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('padecimiento')== 'no' || !old('padecimiento')) checked @endif>
                    No
            </label>
        </div>
    </div>
    <div class="flex items-end">
        <input class="appearance-none w-[300px] text-sm text-gray-600 border rounded leading-tight focus:ring-cianna-orange focus:bg-white focus:border-cianna-orange hover:disabled:cursor-not-allowed" id="nom-padecimiento" name="nom-padecimiento" type="text" placeholder="Si es relevante conocerlo escríbelo aquí" @if(old('padecimiento') == 'si') value="{{old('nom-padecimiento')}}" @else disabled @endif>
    </div>
</div>
