@props(['for' => '', 'value' => ''])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'block font-medium text-sm ']) }}>
    {!! $value ?? $slot !!}
</label>
