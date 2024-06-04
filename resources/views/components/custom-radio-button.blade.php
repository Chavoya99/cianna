@props(['options', 'name', 'selected'])

<div>
    @foreach($options as $value => $label)
        <label class="inline-flex items-center">
            <input type="radio" class="form-radio text-cianna-orange" name="{{ $name }}" value="{{ $value }}" {{ $value == $selected ? 'checked' : '' }}>
            <span class="ml-2 {{ $value == $selected ? : '' }}">{{ $label }}</span>
        </label>
    @endforeach
</div>