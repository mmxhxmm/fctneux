<div {{ $attributes->merge(['class' => 'user-card w-[370px] rounded-xl p-6 bg-white shadow-xl border border-blue hover:shadow-2xl transition-all duration-300', 'tabindex' => 0]) }}>
    
    <!-- Etiqueta de colaboración -->
    <span class="{{ 
        $empresa->colaboracion === 'Prospección' ? 'text-blue bg-blue bg-opacity-10' : 
        ($empresa->colaboracion === 'Inactiva' ? 'text-red-600 bg-red-100' : 'text-green-600 bg-green-100') 
    }} text-sm font-semibold rounded-full px-3 py-1 inline-block mb-4">
        {{ $empresa->colaboracion }}
    </span>

    <!-- Datos de la empresa -->
    <div class="space-y-2 text-sm text-gray-800 font-roboto">
        <p><span class="font-semibold text-blue">Nombre:</span> {{ $empresa->nombre }}</p>
        <p><span class="font-semibold text-blue">CIF:</span> {{ $empresa->cif }}</p>
        <p><span class="font-semibold text-blue">Gestiones:</span> {{ $empresa->gestiones }}</p>
        <p><span class="font-semibold text-blue">Modalidad:</span> {{ $empresa->modalidad }}</p>
        <p><span class="font-semibold text-blue">Familia Personal:</span> {{ $empresa->familiaPersonal }}</p>
        <p><span class="font-semibold text-blue">Municipio:</span> {{ $empresa->municipio }}</p>
        @foreach ($empresa->practica as $practica)
            <p>
                <span class="font-semibold text-blue">Ciclo Formativo:</span> {{ $practica->cicloFormativo }}
                <span class="text-gray-600">({{ $practica->numPlazasAsignadas }} plazas)</span>
            </p>
        @endforeach
    </div>

    <!-- Botón -->
    <div class="mt-6 flex justify-end">
        <a href="{{ route('empresa-detail', ['id' => $empresa->id]) }}">
            <button class="bg-blue text-white font-medium px-4 py-2 rounded-full hover:bg-blue/90 transition">
                Ver más
            </button>
        </a>
    </div>
</div>
