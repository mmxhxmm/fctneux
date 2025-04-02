<div {{ $attributes->merge(['class' => 'user-card w-[370px] h-[370px] p-4 flex-grow-0 shadow-lg opacity-90 border-2 border-blue bg-white', 'tabindex' => 0]) }}>
<span class="{{ $empresa->colaboracion == 'Prospección' ? 'text-blue bg-blue bg-opacity-20' : ($empresa->colaboracion == 'Inactiva' ? 'text-red-500 bg-red-100' : 'text-green-500 bg-green-100') }} rounded-[100px] p-1 px-2">
        {{ $empresa->colaboracion }}
    </span>
    <p class="text-semibold m-4"><b>Nombre: </b>{{ $empresa->nombre }}</p>
    <p class="text-semibold m-4"><b>CIF: </b>{{ $empresa->cif }}</p>
    <p class="text-semibold m-4"><b>Colaboracion: </b>{{ $empresa->colaboracion }}</p>
    <p class="text-semibold m-4"><b>Gestiones: </b>{{ $empresa->gestiones }}</p>
    <p class="text-semibold m-4"><b>Modalidad: </b>{{ $empresa->modalidad }}</p>
    <p class="text-semibold m-4"><b>Familia Personal: </b>{{ $empresa->familiaPersonal }}</p>

    <a href="{{ route('empresa-detail', ['id' => $empresa->id]) }}">
        <button class="bg-blue text-white flex justify-end items-center p-2 rounded-[100px] ml-auto">
            Ver más
        </button>
    </a>
</div>