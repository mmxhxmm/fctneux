<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
