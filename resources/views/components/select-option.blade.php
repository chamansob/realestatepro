@props([
    'placeholder' => $placeholder,
    'selectedOptions' => $selectedOptions,
    'options' => $options,
    'disabled' => false,
])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'form-select',
]) !!}>
    @if (isset($placeholder))
        <option value="" disabled selected>{{ $placeholder }}</option>
    @endif
    @foreach ($options as $key => $option)
        <option value="{{ $key }}"
            @if ($selectedOptions === $key) selected="selected" 
            @elseif (isset($options) and $selectedOptions === $key)
        selected="selected" @endif>
            {{ $option }}</option>
    @endforeach
</select>
