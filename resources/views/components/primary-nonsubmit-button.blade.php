<button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-blue transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>