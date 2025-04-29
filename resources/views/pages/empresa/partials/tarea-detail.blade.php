<section>
    @if($empresa->tareas->isNotEmpty())
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-blue text-white rounded-t-xl">
            <tr>
                <th class="p-4 text-left font-semibold">Asignado a</th>
                <th class="p-4 text-left font-semibold">Nombre</th>
                <th class="p-4 text-left font-semibold">Descripcion</th>
                <th class="p-4 text-left font-semibold">Fecha limite</th>
                <th class="p-4 text-left font-semibold">Estado</th>
                <th class="p-4 text-left font-semibold min-w-[70px]"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <!-- TODO order by estado -->
            @foreach ($empresa->tareas as $tarea)
                @include("pages.tarea.partials.tarea-edit", ['tarea' => $tarea])
                <tr class="hover:bg-blue/5 transition-all">
                    <td class="p-4 text-gray-800 font-bold">{{ $tarea->asignado }}</td>
                    <td class="p-4 text-gray-800">{{ $tarea->nombre }}</td>
                    <td class="p-4 text-gray-800">{{ $tarea->descripcion }}</td>
                    <td class="p-4 text-gray-800">{{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('d-m-Y') }}</td>
                    <td class="p-4 text-gray-800">
                        <form method="POST" action="{{ route('tarea.update_estado', ['id' => $tarea->id]) }}">
                            @csrf
                            @method('PATCH')

                            <select name="estado" onchange="this.form.submit()"
                                class="text-sm font-semibold shadow-sm rounded-full w-[120px] px-2 py-1 cursor-pointer transition-all bg-white_dull text-blue hover:bg-white_dull">
                                <option value="to_do" {{ $tarea->estado === 'to_do' ? 'selected' : '' }}>Por hacer</option>
                                <option value="in_progress" {{ $tarea->estado === 'in_progress' ? 'selected' : '' }}>En progreso</option>
                                <option value="revision" {{ $tarea->estado === 'revision' ? 'selected' : '' }}>En revisión</option>
                                <option value="blocked" {{ $tarea->estado === 'blocked' ? 'selected' : '' }}>Bloqueado</option>
                                <option value="done" {{ $tarea->estado === 'done' ? 'selected' : '' }}>Completada</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <button 
                            type="button" 
                            class="openEditModal px-2 rounded top-4 right-6 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
                            data-tarea-id="{{ $tarea->id }}"> Editar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div>
            <p class="text-center mt-10">No existen Tareas</p>
        </div>
    @endif

    <!-- Add -->
    @include("pages.tarea.partials.tarea-form")
    <div class="mt-10 w-full flex justify-end">
        <button id="openModal" class="bg-orange rounded-[100px] w-[110px] h-10 flex justify-center items-center">
            <p class="text-white text-base font-bold">+ Añadir</p>
        </button>
    </div>
</section>

<script>
    // Get the modal, open button, and close button
    const modal = document.getElementById("myModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.getElementById("closeModal");

    // Add
    openModalBtn.onclick = function() {
        modal.classList.remove("hidden");
    };
    closeModalBtn.onclick = function() {
        modal.classList.add("hidden");
    };

    // Edit Modal
    document.querySelectorAll(".openEditModal").forEach(button => {
        button.addEventListener('click', function() {
            const tareaId = this.getAttribute('data-tarea-id');
            const modal = document.getElementById(`EditModal-${tareaId}`);
            modal.classList.remove("hidden");
        });
    });

    document.querySelectorAll(".closeEditModal").forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            modal.classList.add("hidden");
        });
    });

    function multiSelect() {
        return {
            open: false,
            search: '',
            selected: [],
            users: @json($usuarios->map(fn($u) => ['id' => $u->id, 'name' => $u->name])),
            toggle(user) {
                if (this.selected.includes(user.id)) {
                    this.selected = this.selected.filter(id => id !== user.id);
                } else {
                    this.selected.push(user.id);
                }
            },
            selectedLabels() {
                return this.users
                    .filter(u => this.selected.includes(u.id))
                    .map(u => u.name);
            },
            filteredUsers() {
                if (!this.search) return this.users;
                return this.users.filter(u => u.name.toLowerCase().includes(this.search.toLowerCase()));
            }
        };
    }
</script>