<div 
    data-aos="fade-up"
    data-aos-offset="150"
    data-aos-once="true"
    {{ $attributes->merge([
        'class' => 'user-card w-[342px] flex flex-col justify-between relative rounded-xl bg-white shadow-xl border border-blue hover:shadow-2xl transition-all duration-300',
        'tabindex' => 0
    ]) }}
>
    <div>
        <!-- Dropdown Status Form -->
        <form method="POST" action="{{ route('tarea.update_estado', ['id' => $tarea->id]) }}">
            @csrf
            @method('PATCH')

            <div class="absolute top-4 left-4">
                <select name="estado" id="estado" onchange="this.form.submit()"
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

        <button 
            id="openEditModal"
            type="button" 
            class="edit-btn absolute px-2 rounded top-4 right-6 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-tarea-id="{{ $tarea->id }}"
            data-tarea-nombre="{{ $tarea->nombre }}"
            data-tarea-descripcion="{{ $tarea->descripcion }}"
            data-tarea-estado="{{ $tarea->estado }}"
            data-tarea-fecha-limite="{{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('Y-m-d') }}"
            data-tarea-asignado="{{ $tarea->asignado }}"
            data-tarea-empresa="{{ $tarea->empresa }}"> Editar
        </button>

        <!-- Tarea Content -->
        <div class="pt-10 pb-5 px-6 space-y-4 text-[17px] text-gray-800 font-roboto mt-8">
            <p><span class="font-semibold text-blue">Nombre:</span> {{ $tarea->nombre }}</p>
            <p><span class="font-semibold text-blue">Descripción:</span> {{ $tarea->descripcion }}</p>
            <p><span class="font-semibold text-blue">Fecha Límite:</span> {{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('d-m-Y') }}</p>
        </div>
    </div>

    <!-- Footer -->
    <div>
        <div class="w-full flex justify-center mt-3 mb-6">
            <a href="{{ route('empresa-detail', ['id' => $tarea->empresa->id]) }}" class="w-full mx-4">
                <p class="bg-blue text-white font-semibold text-sm px-5 py-2 flex items-center justify-center gap-x-1 rounded-full hover:bg-blue/90 transition shadow-sm">
                    <img src="{{ asset('images/icons/icons8-business-96.png') }}" alt="Icono de Empresa" width="20px" class="invert brightness-0">
                    {{ $tarea->empresa->nombre }}
                </p>
            </a>
        </div>
        <div class="px-6 py-4 bg-white_dull w-full rounded-b-xl">
            <p><span class="font-semibold text-blue">Asignado a:</span> {{ $tarea->asignado }}</p> 
        </div>
    </div>
</div>
