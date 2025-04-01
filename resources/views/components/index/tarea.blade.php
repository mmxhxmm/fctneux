<div {{ $attributes->merge(['class' => 'user-card w-[342px] p-4 flex-grow-0 shadow-lg opacity-90 border-2 border-blue bg-white', 'tabindex' => 0]) }}>
    <p class="text-semibold m-4"><b>Nombre: </b>{{ $tarea->nombre }}</p>
    <p class="text-semibold m-4"><b>Asignado a: </b>{{ $tarea->asignado }}</p>
    <p class="text-semibold m-4"><b>Descripcion: </b>{{ $tarea->descripcion }}</p>
    <p class="text-semibold m-4"><b>Fecha Límite: </b>{{ $tarea->fecha_limite }}</p>
    <p class="text-semibold m-4"><b>Empresa Nombre: </b>{{ $tarea->empresa->nombre }}</p>
</div>