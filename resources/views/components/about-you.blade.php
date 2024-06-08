<!-- resources/views/components/custom-textarea.blade.php -->

<div class="relative">
    <textarea id="desc" name="desc" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cianna-orange focus:ring focus:ring-cianna-orange focus:ring-opacity-50" 
    placeholder="Puedes hablar sobre tus gustos e intereses" maxlength="300" 
    autofocus>@if(old('desc')){{old('desc')}}@endif</textarea>
    <div class="absolute bottom-0 right-0 mb-2 mr-5 text-gray-500">
        <span id="char-count">300</span> caracteres restantes
    </div>
</div>
