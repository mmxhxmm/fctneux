<div {{ $attributes->merge(['class' => 'user-card w-[342px] h-[342px] p-4 flex-grow-0 shadow-lg opacity-90 border-2 border-primary bg-white', 'tabindex' => 0]) }}>
    <p class="text-semibold m-4"><b>Nombre: </b>{{ $empresa->nombre }}</p>
    <p class="text-semibold m-4"><b>CIF: </b>{{ $empresa->cif }}</p>
    <p class="text-semibold m-4"><b>Colaboracion: </b>{{ $empresa->colaboracion }}</p>
    <p class="text-semibold m-4"><b>Gestiones: </b>{{ $empresa->gestiones }}</p>
    <p class="text-semibold m-4"><b>Modalidad: </b>{{ $empresa->modalidad }}</p>
    <p class="text-semibold m-4"><b>Familia Personal: </b>{{ $empresa->familiaPersonal }}</p>
</div>