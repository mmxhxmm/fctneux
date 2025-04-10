<div 
    data-aos="fade-up"
    data-aos-offset="150"
    data-aos-once="false"
    {{ $attributes->merge([
        'class' => 'user-card w-[342px] py-10 relative rounded-xl p-6 bg-white shadow-xl border border-blue hover:shadow-2xl transition-all duration-300',
        'tabindex' => 0
    ]) }}
>

    <!-- Dropdown Status Form -->
    <form method="POST" action="{{ route('tarea.markAsDone', ['id' => $tarea->id]) }}">
    @csrf
    @method('PATCH')
    <div class="absolute top-4 left-4">
        <select name="estado" onchange="this.form.submit()"
            class="text-sm font-semibold shadow-sm rounded-full w-[120%] px-3 py-1 cursor-pointer transition-all
            {{ $tarea->estado === 'done' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-white_dull text-blue hover:bg-white_dull' }}">
            <option value="to_do" {{ $tarea->estado === 'to_do' ? 'selected' : '' }}>Por hacer</option>
            <option value="in_progress" {{ $tarea->estado === 'in_progress' ? 'selected' : '' }}>En progreso</option>
            <option value="revision" {{ $tarea->estado === 'revision' ? 'selected' : '' }}>En revisión</option>
            <option value="blocked" {{ $tarea->estado === 'blocked' ? 'selected' : '' }}>Bloqueado</option>
            <option value="done" {{ $tarea->estado === 'done' ? 'selected' : '' }}>Completada</option>
        </select>
    </div>
</form>


    <!-- Tarea Content -->
    <div class="space-y-4 text-[17px] text-gray-800 font-roboto mt-8">
        <p><span class="font-semibold text-blue">Nombre:</span> {{ $tarea->nombre }}</p>
        <p><span class="font-semibold text-blue">Asignado a:</span> {{ $tarea->asignado }}</p>
        <p><span class="font-semibold text-blue">Descripción:</span> {{ $tarea->descripcion }}</p>
        <p><span class="font-semibold text-blue">Fecha Límite:</span> {{ $tarea->fecha_limite }}</p>
        <p><span class="font-semibold text-blue">Empresa:</span> {{ $tarea->empresa->nombre }}</p>
    </div>
</div>

