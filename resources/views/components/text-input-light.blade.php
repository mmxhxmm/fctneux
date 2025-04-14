@props(['disabled' => false, 'value' => ''])

<input 
    value="{{ $value }}"
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full px-2 py-1 border-gray-700 bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}
>