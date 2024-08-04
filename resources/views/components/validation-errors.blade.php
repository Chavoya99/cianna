{{--@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('¡Ups! Algo salió mal.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
--}}

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mx-5 my-5 rounded relative" role="alert">
        <strong class="font-bold">¡Algo salió mal!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
