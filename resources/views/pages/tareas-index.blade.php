<x-app-layout>
@php
    $usuarios = \App\Models\User::all(); // or however you load your users
@endphp
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[350px] mb-10 flex-grow-0 flex-shrink-0" style="background-image: url('../images/tareasheader.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <!-- <div class="absolute inset-0 bg-primary opacity-40"></div> -->
            
            <!-- Main Heading and Buttons -->
            <div class="bg-black_transp h-16 relative flex justify-between items-center px-10 w-full">
                <!-- Left buttons (Añadir and Eliminar) -->
                <div class="flex items-center">
                    <!-- Añadir button -->
                    <div class="w-[110px] h-10">
                        <div class="bg-[#ff8300] rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                            <button id="openModal" class="text-white font-roboto text-base font-bold">+ Añadir</button>
                        </div>
                    </div>

                    <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="w-full max-w-6xl bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-blue">
                            <!-- Header -->
                            <div class="bg-blue px-6 py-4 flex justify-between items-center">
                                <h2 class="text-xl font-semibold text-white">📋 Datos de la Tarea</h2>
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
                                    <form id="taskForm" class="space-y-5">
                                        <div>
                                            <label for="nombre-tarea" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la tarea</label>
                                            <input type="text" name="nombre-tarea" id="nombre-tarea" required
                                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
                                        </div>

                                        <div>
                                            <label for="estado-tarea" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                                            <select name="estado-tarea" id="estado-tarea"
                                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
                                                <option value="to_do">Por hacer</option>
                                                <option value="in_progress">En progreso</option>
                                                <option value="revision">En revisión</option>
                                                <option value="blocked">Bloqueado</option>
                                                <option value="done">Completada</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="desc-tarea" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                                            <textarea name="desc-tarea" id="desc-tarea" rows="3"
                                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue"></textarea>
                                        </div>

                                        <div x-data="multiSelect()" class="relative">
                                            <label for="asig-tarea" class="block text-sm font-medium text-gray-700 mb-1">Asignado a</label>

                                            <!-- Hidden input to store selected user IDs (comma-separated) -->
                                            <input type="hidden" name="asig_tarea_ids" :value="selected.join(',')" />

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


                                        <div>
                                            <label for="fecha-tarea" class="block text-sm font-medium text-gray-700 mb-1">Fecha límite</label>
                                            <input type="date" name="fecha-tarea" id="fecha-tarea"
                                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
                                        </div>

                                        <!-- Buttons -->
                                        <div class="flex justify-end gap-4 pt-4">
                                            <button type="submit"
                                                class="bg-blue hover:bg-blue-700 transition text-white font-semibold px-5 py-2 rounded-full shadow-sm">Guardar</button>
                                            <button type="button"
                                                class="bg-orange hover:bg-orange-600 transition text-white font-semibold px-5 py-2 rounded-full shadow-sm">Eliminar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Section (Filter, Barcelona / BCN, and Search) -->
                <div class="flex items-center space-x-4">
                    <!-- Filter Section -->
                    <div class="relative">
                        <div class="bg-black_transp w-[200px] h-[40px] rounded-[100px] border-2 border-white flex items-center pl-4 pr-2">
                            <img class="w-[20px] h-[20px]" src="../images/filter-svg.svg" alt="Filter Icon" />
                            <div class="text-white font-roboto text-base font-medium ml-2">
                                Filter
                            </div>
                        </div>
                    </div>

                    <!-- Search Section -->
                    <form action="{{ route('tareas-busqueda') }}" method="GET" class="relative">
                        <div class="bg-black_transp w-[200px] h-[40px] rounded-full border-2 border-white flex items-center pl-4 pr-2 transition focus-within:ring-2 focus-within:ring-white">
                            <input
                                type="text"
                                name="search"
                                placeholder="Buscar tarea..."
                                class="bg-transparent border border-transparent border-none text-white text-sm font-medium w-full focus:outline-none placeholder-white"
                                value="{{ request('search') }}"
                            />
                            <button type="submit">
                                <img class="w-[20px] h-[20px]" src="../images/svg-buscar.svg" alt="Search Icon" />
                            </button>
                        </div>
                    </form>
                    <button id="toggleView" onclick="toggleLayout()" class="w-10 h-10 rounded-full bg-white text-blue border border-blue flex items-center justify-center hover:bg-blue hover:text-white transition">
                        <!-- Grid Icon -->
                        <svg id="iconGrid" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h4v4H4V6zM10 6h4v4h-4V6zM16 6h4v4h-4V6zM4 12h4v4H4v-4zM10 12h4v4h-4v-4zM16 12h4v4h-4v-4z"/>
                        </svg>

                        <!-- List Icon (initially hidden) -->
                        <svg id="iconList" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                </div>
            </div>

            <div class="w-full h-full flex flex-col  absolute px-4">
                <div class="absolute left-0 top-[4em] animate-left">
                    <a href="/"  class="hover:text-white hover:border-none justify-start p-2 px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6"><<< Volver al inicio</a>
                    <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6">
                        {{ __('<<< Volver al inicio') }}
                    </x-nav-link> -->
                </div>
                <div class="absolute right-0 top-[8em] animate-right">
                    <a href="{{ route('tareas-historial') }}" class="hover:text-white hover:border-none justify-end px-4 rounded-tl-[0px] rounded-tl-[50px] rounded-bl-[50px] rounded-bl-[0px] px-4 bg-blue w-[200px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 flex justify-end items-center"> Historial de tareas >>></a>
                    <!-- <x-nav-link :href="route('tareas-historial')" :active="request()->routeIs('tareas-historial')" class="hover:text-white hover:border-none justify-end px-4 rounded-tl-[0px] rounded-tl-[50px] rounded-bl-[50px] rounded-bl-[0px] px-4 bg-blue w-[200px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 flex justify-end items-center">
                    {{__('Historial de tareas >>>') }} </a> 
                    </x-nav-link> -->
                </div>
                <div class="text-center justify-center mt-14 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Plataforma de <span class="text-two font-roboto_condensed_bold text-orange">Tareas</span>
                    </p>
                </div>
            </div>
        </div>

        <div  class="flex justify-center bg-white items-center">
            <div id="tareasContainer" class="grid grid-cols-3 gap-6">
                @foreach ($tareas as $key => $tarea)
                    <x-index.tarea :tarea="$tarea"></x-index-box>
                    @if ($key == 8) <!-- After the 9th user, break the loop -->
                        @break
                    @endif
                @endforeach
            </div>
            <div id="tareasList" class="hidden w-[90%] px-5 py-6 transition-all">
                <div class="overflow-x-auto bg-white rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 text-sm font-roboto">
                        <thead class="bg-blue text-white rounded-t-xl">
                            <tr>
                                <th class="p-4 text-left font-semibold">Nombre</th>
                                <th class="p-4 text-left font-semibold">Asignado a</th>
                                <th class="p-4 text-left font-semibold">Estado</th>
                                <th class="p-4 text-left font-semibold">Descripcion</th>
                                <th class="p-4 text-left font-semibold">Fecha limite</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($tareas as $key => $tarea)
                                <tr class="hover:bg-blue/5 transition-all">
                                    <td class="p-4 text-gray-800">{{ $tarea->nombre }}</td>
                                    <td class="p-4 text-gray-800">{{ $tarea->asignado }}</td>
                                    <td class="p-4 text-gray-800"><select name="estado" onchange="this.form.submit()"
                                        class="text-sm font-semibold shadow-sm rounded-full w-[90%] px-3 py-1 cursor-pointer transition-all
                                        {{ $tarea->estado === 'done' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-white_dull text-blue hover:bg-white_dull' }}">
                                        <option value="to_do" {{ $tarea->estado === 'to_do' ? 'selected' : '' }}>Por hacer</option>
                                        <option value="in_progress" {{ $tarea->estado === 'in_progress' ? 'selected' : '' }}>En progreso</option>
                                        <option value="revision" {{ $tarea->estado === 'revision' ? 'selected' : '' }}>En revisión</option>
                                        <option value="blocked" {{ $tarea->estado === 'blocked' ? 'selected' : '' }}>Bloqueado</option>
                                        <option value="done" {{ $tarea->estado === 'done' ? 'selected' : '' }}>Completada</option>
                                    </select></td>
                                    <td class="p-4 text-gray-800">{{ $tarea->descripcion }}</td>
                                    <td class="p-4 text-gray-800">{{ $tarea->fecha_limite }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="relative h-[420px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/bottomtareas.png'); background-size: cover; background-position: center;">
            <!-- Button is absolutely positioned in the center of the image -->
            <!-- <div class="absolute inset-0 flex justify-center items-center">
                <button class="p-4 bg-blue rounded-lg text-white w-[120px]">Ver todos</button>
            </div> -->
        </div>
    </div>

    <!-- JavaScript (for Search functionality) -->
    <script>

        // Get the modal, open button, and close button
        const modal = document.getElementById("myModal");
        const openModalBtn = document.getElementById("openModal");
        const closeModalBtn = document.getElementById("closeModal");

        // Open the modal
        openModalBtn.onclick = function() {
            modal.classList.remove("hidden"); // Show the modal
        };

        // Close the modal
        closeModalBtn.onclick = function() {
            modal.classList.add("hidden"); // Hide the modal
        };

        // Close the modal if clicked outside the modal content
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.classList.add("hidden"); // Hide the modal if clicked outside
            }
        };
        document.getElementById('searchForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form behavior
            const query = document.getElementById('searchInput').value.trim();

            if (query) {
                console.log('Searching for:', query);

                // Example of filtering logic (adapt to your needs)
                // You can also make an AJAX request here if needed

                // Or redirect:
                // window.location.href = `?search=${encodeURIComponent(query)}`;
            }
        });

        function toggleLayout() {
            const grid = document.getElementById('tareasContainer');
            const list = document.getElementById('tareasList');
            const iconGrid = document.getElementById('iconList');
            const iconList = document.getElementById('iconGrid');

            const isGridVisible = !grid.classList.contains('hidden');

            if (isGridVisible) {
                grid.classList.add('hidden');
                list.classList.remove('hidden');
                iconGrid.classList.add('hidden');
                iconList.classList.remove('hidden');
            } else {
                grid.classList.remove('hidden');
                list.classList.add('hidden');
                iconGrid.classList.remove('hidden');
                iconList.classList.add('hidden');
            }
        }
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
</x-app-layout>
