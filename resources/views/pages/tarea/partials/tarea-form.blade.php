<section id="myModal" class="px-10 fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="w-full max-w-6xl bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-blue">
        <!-- Header -->
        <div class="bg-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white flex items-center gap-x-1">
                <img src="{{ asset('images/icons/icons8-address-book-96.png') }}" alt="" width="20px" class="invert brightness-0">
                <p>Datos de la Tarea</p>
            </h2>
            <button id="closeModal" class="text-white text-xl hover:text-orange transition-all">✕</button>
        </div>

        <!-- Content -->
        <div class="p-8 flex flex-col md:flex-row gap-8">
            <!-- Left Column: Calendar -->
            <div class="w-full md:w-1/2 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                <iframe src="https://calendar.google.com/calendar/embed?src=your-calendar-id&ctz=Europe%2FMadrid"
                    width="100%" height="400px" frameborder="0" scrolling="no" class="rounded-lg"></iframe>
            </div>

            <!-- Right Column: Form -->
            <div class="w-full md:w-1/2">
                <form id="taskForm" action="{{ route('tareas-store') }}" autocomplete="off" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la tarea <span class='text-red-500'>*</span></label>
                        <input type="text" name="nombre" id="nombre" required
                            class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue"></textarea>
                    </div>
                    <div class="grid gap-6 {{ !(request()->routeIs('empresa-detail')) ? 'grid-cols-2' : 'grid-cols-1' }}">
                        <!-- Asignado a -->
                        <div x-data="multiSelect()" class="relative">
                            <label for="asignado" class="block text-sm font-medium text-gray-700 mb-1">Asignado a</label>

                            <!-- Hidden input to store selected user IDs (comma-separated) -->
                            <input type="hidden" name="asignado" :value="selected.join(',')" />

                            <!-- Clickable input -->
                            <div class="border border-gray-300 rounded-md px-3 py-2 bg-white text-black cursor-pointer shadow-sm" @click="open = !open">
                                <template x-if="selected.length > 0">
                                    <span x-text="selectedLabels().join(', ')"></span>
                                </template>
                                <template x-if="selected.length === 0">
                                    <span class="text-gray-400">Selecciona usuarios...</span>
                                </template>
                            </div>

                            <!-- Dropdown -->
                            <div x-show="open" @click.outside="open = false"
                                class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg h-40 overflow-y-auto">

                                <!-- Search input -->
                                <div class="px-3 py-2 border-b border-gray-200">
                                    <input type="text" x-model="search" placeholder="Buscar usuario..." class="w-full px-2 py-1 border border-gray-300 rounded text-sm">
                                </div>

                                <!-- Filtered results -->
                                <template x-for="user in filteredUsers()" :key="user.id">
                                    <div class="px-4 py-2 hover:bg-gray-100 flex items-center gap-2 cursor-pointer"
                                        @click="toggle(user)">
                                        <input type="checkbox" :checked="selected.includes(user.id)" class="form-checkbox">
                                        <span x-text="user.name"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                        
                        <!-- Empresa -->
                        @if (!(request()->routeIs('empresa-detail')))
                            <div>
                                <label for="empresa" class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
                                <select name="empresa" id="empresa"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="empresa" id="empresa" value="{{ $empresa->id }}">
                        @endif
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                            <select name="estado" id="estado"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
                                <option value="to_do">Por hacer</option>
                                <option value="in_progress">En progreso</option>
                                <option value="revision">En revisión</option>
                                <option value="blocked">Bloqueado</option>
                                <option value="done">Completada</option>
                            </select>
                        </div>
                        <!-- Fecha Limite -->
                        <div>
                            <label for="fecha_limite" class="block text-sm font-medium text-gray-700 mb-1">Fecha límite</label>
                            <input type="date" name="fecha_limite" id="fecha_limite"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="submit"
                            class="bg-blue hover:bg-blue-700 transition text-white font-semibold px-5 py-2 rounded-full shadow-sm">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>