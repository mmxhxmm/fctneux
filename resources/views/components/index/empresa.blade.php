<div 
    data-aos="fade-up"
    data-aos-offset="150"
    data-aos-once="false"
    {{ $attributes->merge([
        'class' => 'user-card w-[380px] rounded-2xl p-6 bg-white border border-blue shadow-md hover:shadow-blue/30 transition-all duration-300',
        'tabindex' => 0
    ]) }}>

    <!-- Etiqueta de colaboración -->
    <span class="{{ 
        $empresa->colaboracion === 'Prospección' ? 'bg-blue/10 text-blue' : 
        ($empresa->colaboracion === 'Inactiva' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700') 
    }} text-xs font-semibold rounded-full px-3 py-1 inline-block mb-5 uppercase tracking-wide">
        {{ $empresa->colaboracion }}
    </span>

    <!-- Datos de la empresa -->
    <div class="space-y-3 text-[15px] text-gray-800 font-roboto leading-relaxed">
        <p><span class="text-blue font-semibold">Nombre:</span> {{ $empresa->nombre }}</p>
        <p><span class="text-blue font-semibold">CIF:</span> {{ $empresa->cif }}</p>
        <p><span class="text-blue font-semibold">Gestiones:</span> {{ $empresa->gestiones }}</p>
        <p><span class="text-blue font-semibold">Modalidad:</span> {{ $empresa->modalidad }}</p>
        <p><span class="text-blue font-semibold">Familia Personal:</span> {{ $empresa->familiaPersonal }}</p>
        <p><span class="text-blue font-semibold">Municipio:</span> {{ $empresa->municipio }}</p>

        @foreach ($empresa->practica as $practica)
            <div class="flex justify-between items-center text-sm text-gray-700">
                <span><span class="text-blue font-semibold">Ciclo:</span> {{ $practica->cicloFormativo }}</span>
                <span class="text-gray-500">({{ $practica->numPlazasAsignadas }} plazas)</span>
            </div>
        @endforeach
    </div>

    <!-- Botón -->
    <div class="mt-6 flex justify-end">
        <a href="{{ route('empresa-detail', ['id' => $empresa->id]) }}">
            <button class="bg-blue text-white font-semibold text-sm px-5 py-2 rounded-full hover:bg-blue/90 transition shadow-sm">
                Ver más
            </button>
        </a>
    </div>
</div>
