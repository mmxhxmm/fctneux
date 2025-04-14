@props(['disabled' => false])

<select {{ $attributes->merge(['class' => 'mt-0 w-full px-2 py-1 border-gray-700 bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}
    @disabled($disabled)>
    {{ $slot }}
</select>