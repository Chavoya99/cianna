<!-- resources/views/components/custom-checkbox.blade.php -->
@props(['id', 'name', 'value', 'label', 'checked' => false])

<div class="flex items-center">
    <input id="{{ $id }}" name="{{ $name }}" type="checkbox" value="{{ $value }}" {{ $checked ? 'checked' : '' }} {{ $attributes->merge(['class' => 'form-checkbox h-5 w-5 text-cianna-orange focus:ring-cianna-orange rounded-md hover:cursor-pointer']) }}>
    <label for="{{ $id }}" class="ml-2 block text-sm text-gray-900">
        {{ $label }}
    </label>
</div>