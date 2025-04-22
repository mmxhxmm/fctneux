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
                        <div class="bg-orange rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                            <button id="openModal" class="text-white font-roboto text-base font-bold">+ Añadir</button>
                        </div>
                    </div>

                    @include("pages.partials.tarea-form")

                </div>

                <!-- Right Section (Filter, Barcelona / BCN, and Search) -->
                <div class="flex items-center space-x-4">
                    <div class="relative inline-block w-full">
                        <div 
                            x-data="{
                                selectedFilters: {{ json_encode(array_values(array_filter([
                                    request()->has('asignado') ? 'asignado' : null,
                                    request()->has('estado') ? 'estado' : null,
                                    request()->has('fecha_limite') ? 'fecha_limite' : null,
                                    request()->has('empresa_id') ? 'empresa_id' : null,
                                ]))) }},
                                toggleFilter(type) {
                                    if (this.selectedFilters.includes(type)) {
                                        this.selectedFilters = this.selectedFilters.filter(f => f !== type);
                                        if (this.selectedFilters.length === 0) {
                                            window.location.href = '{{ route("tareas.filtro") }}';
                                        }
                                    } else {
                                        this.selectedFilters.push(type);
                                    }
                                }
                            }"
                            class="w-full flex flex-wrap items-center gap-3"
                        >

                            <!-- + Filtro Selector -->
                            <div class="relative">
                                <select 
                                    @change="toggleFilter($event.target.value); $event.target.value=''" 
                                    class="bg-black_transp w-[200px] h-[40px] text-white rounded-full border-2 border-white px-4 pr-10 appearance-none cursor-pointer"
                                >
                                    <option value="">+ Filtro</option>
                                    <option value="asignado" :disabled="selectedFilters.includes('asignado')">Asignado a</option>
                                    <option value="estado" :disabled="selectedFilters.includes('estado')">Estado</option>
                                    <option value="fecha_limite" :disabled="selectedFilters.includes('fecha_limite')">Fecha límite</option>
                                    <option value="empresa_id" :disabled="selectedFilters.includes('empresa_id')">Empresa</option>
                                </select>
                            </div>

                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('tareas.filtro') }}" class="flex flex-wrap items-center gap-3">

                                <!-- Asignado Dropdown with Search and Multi-Select -->
                                <template x-if="selectedFilters.includes('asignado')">
                                    <div class="relative inline-block w-[200px]">
                                        <div 
                                            x-data="{
                                                open: false,
                                                search: '',
                                                selected: @js(request()->input('asignado', [])),
                                                options: @js(array_values($asignados->toArray())),
                                                toggle(option) {
                                                    if (this.selected.includes(option)) {
                                                        this.selected = this.selected.filter(o => o !== option);
                                                    } else {
                                                        this.selected.push(option);
                                                    }
                                                }
                                            }"
                                        >
                                            <!-- "Select"-style button -->
                                            <button type="button" @click="open = !open"
                                                class="flex items-center justify-between w-full h-[40px] rounded-full border-2 border-white bg-black_transp text-white px-4 cursor-pointer">
                                                <span class="truncate w-full text-left" x-text="selected.length > 0 ? selected.join(', ') : 'Asignado a'"></span>
                                                <svg class="w-4 h-4 ml-2 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown Content -->
                                            <div x-show="open" x-transition @click.away="open = false"
                                                class="absolute z-50 mt-2 w-full bg-black_transp border border-white text-white rounded-xl shadow-lg">
                                                
                                                <!-- Search input -->
                                                <div class="px-3 py-2 border-b border-white flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l7-7-7-7" />
                                                    </svg>
                                                    <input
                                                        x-model="search"
                                                        type="text"
                                                        placeholder="Buscar..."
                                                        class="w-full bg-transparent text-white placeholder-white outline-none"
                                                    >
                                                </div>

                                                <!-- Filtered list of checkboxes -->
                                                <ul class="max-h-40 overflow-y-auto px-2">
                                                    <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                                        <li @click.stop="toggle(option)" class="flex items-center gap-2 px-2 py-2 cursor-pointer hover:bg-gray-700 rounded">
                                                            <input type="checkbox" :checked="selected.includes(option)" class="form-checkbox text-white bg-transparent border-white rounded-sm">
                                                            <span x-text="option"></span>
                                                        </li>
                                                    </template>
                                                    <li x-show="options.filter(o => o.toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-2 text-gray-400">
                                                        No hay coincidencias
                                                    </li>
                                                </ul>

                                                <!-- Submit -->
                                                <div class="border-t border-white px-4 py-2 text-right">
                                                    <button type="submit"
                                                        class="text-sm bg-white text-black font-semibold px-3 py-1 rounded-full hover:bg-gray-200 transition">
                                                        Aplicar
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Hidden selected values -->
                                            <template x-for="value in selected" :key="value">
                                                <input type="hidden" name="asignado[]" :value="value">
                                            </template>
                                        </div>

                                        <!-- ❌ Cancel button -->
                                        <button type="button" @click="toggleFilter('asignado')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow hover:bg-red-700 transition">
                                            &times;
                                        </button>
                                    </div>
                                </template>


                                <!-- Estado Dropdown (No Search, Just Options) -->
                                <template x-if="selectedFilters.includes('estado')">
                                    <div class="relative inline-block w-[200px]">
                                        <div 
                                            x-data="{
                                                open: false,
                                                selected: @js(request()->input('estado', [])),
                                                options: @js(array_keys($estados)),
                                                labels: @js($estados),
                                                toggle(option) {
                                                    if (this.selected.includes(option)) {
                                                        this.selected = this.selected.filter(o => o !== option);
                                                    } else {
                                                        this.selected.push(option);
                                                    }
                                                }
                                            }"
                                        >
                                            <!-- Select-style Button -->
                                            <button type="button" @click="open = !open"
                                                class="flex items-center justify-between w-full h-[40px] rounded-full border-2 border-white bg-black_transp text-white px-4 cursor-pointer">
                                                <span class="truncate w-full text-left" 
                                                    x-text="selected.length > 0 ? selected.map(k => labels[k]).join(', ') : 'Estado'"></span>
                                                <svg class="w-4 h-4 ml-2 transform transition-transform" 
                                                    :class="{ 'rotate-180': open }" 
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown -->
                                            <div x-show="open" x-transition @click.away="open = false"
                                                class="absolute z-50 mt-2 w-full bg-black_transp border border-white text-white rounded-xl shadow-lg">

                                                <!-- Options -->
                                                <ul class="max-h-40 overflow-y-auto px-2 py-2">
                                                    <template x-for="option in options" :key="option">
                                                        <li @click.stop="toggle(option)" class="flex items-center gap-2 px-2 py-1 cursor-pointer hover:bg-gray-700 rounded">
                                                            <input type="checkbox" :checked="selected.includes(option)" class="form-checkbox text-white bg-transparent border-white rounded-sm">
                                                            <span x-text="labels[option]"></span>
                                                        </li>
                                                    </template>
                                                </ul>

                                                <!-- Apply Button -->
                                                <div class="border-t border-white px-4 py-2 text-right">
                                                    <button type="submit"
                                                        class="text-sm bg-white text-black font-semibold px-3 py-1 rounded-full hover:bg-gray-200 transition">
                                                        Aplicar
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Hidden Inputs -->
                                            <template x-for="value in selected" :key="value">
                                                <input type="hidden" name="estado[]" :value="value">
                                            </template>
                                        </div>

                                        <!-- ❌ Cancel Button -->
                                        <button type="button" @click="toggleFilter('estado')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow hover:bg-red-700 transition">
                                            &times;
                                        </button>
                                    </div>
                                </template>

                                <!-- Fecha límite Dropdown with Search and Multi-Select -->
                                <template x-if="selectedFilters.includes('fecha_limite')">
                                    <div class="relative inline-block w-[200px]">
                                        <div 
                                            x-data="{
                                                open: false,
                                                search: '',
                                                selected: @js(request()->input('fecha_limite', [])),
                                                options: @js(array_keys($fechas_limite->toArray())),
                                                labels: @js($fechas_limite->toArray()),
                                                toggle(option) {
                                                    if (this.selected.includes(option)) {
                                                        this.selected = this.selected.filter(o => o !== option);
                                                    } else {
                                                        this.selected.push(option);
                                                    }
                                                }
                                            }"
                                        >
                                            <!-- Select-like Button -->
                                            <button type="button" @click="open = !open"
                                                class="flex items-center justify-between w-full h-[40px] rounded-full border-2 border-white bg-black_transp text-white px-4 cursor-pointer">
                                                <span class="truncate w-full text-left" 
                                                    x-text="selected.length > 0 ? selected.join(', ') : 'Fecha límite'"></span>
                                                <svg class="w-4 h-4 ml-2 transform transition-transform" 
                                                    :class="{ 'rotate-180': open }" 
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown -->
                                            <div x-show="open" x-transition @click.away="open = false"
                                                class="absolute z-50 mt-2 w-full bg-black_transp border border-white text-white rounded-xl shadow-lg">
                                                
                                                <!-- Search -->
                                                <div class="px-3 py-2 border-b border-white flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l7-7-7-7" />
                                                    </svg>
                                                    <input
                                                        x-model="search"
                                                        type="text"
                                                        placeholder="Buscar fecha..."
                                                        class="w-full bg-transparent text-white placeholder-white outline-none"
                                                        autocomplete="off"
                                                    >
                                                </div>

                                                <!-- Options -->
                                                <ul class="max-h-40 overflow-y-auto px-2">
                                                    <template x-for="option in options.filter(o => o.toLowerCase().includes(search.toLowerCase()))" :key="option">
                                                        <li @click.stop="toggle(option)" class="flex items-center gap-2 px-2 py-2 cursor-pointer hover:bg-gray-700 rounded">
                                                            <input type="checkbox" :checked="selected.includes(option)" class="form-checkbox text-white bg-transparent border-white rounded-sm">
                                                            <span x-text="labels[option]"></span>
                                                        </li>
                                                    </template>
                                                    <li x-show="options.filter(o => o.toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-2 text-gray-400">
                                                        No hay coincidencias
                                                    </li>
                                                </ul>

                                                <!-- Apply -->
                                                <div class="border-t border-white px-4 py-2 text-right">
                                                    <button type="submit"
                                                        class="text-sm bg-white text-black font-semibold px-3 py-1 rounded-full hover:bg-gray-200 transition">
                                                        Aplicar
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Hidden selected inputs -->
                                            <template x-for="value in selected" :key="value">
                                                <input type="hidden" name="fecha_limite[]" :value="value">
                                            </template>
                                        </div>

                                        <!-- ❌ Cancel -->
                                        <button type="button" @click="toggleFilter('fecha_limite')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow hover:bg-red-700 transition">
                                            &times;
                                        </button>
                                    </div>
                                </template>


                                <!-- Empresa Dropdown with Search and Multi-Select -->
                                <template x-if="selectedFilters.includes('empresa_id')">
                                    <div class="relative inline-block w-[200px]">
                                        <div 
                                            x-data="{
                                                open: false,
                                                search: '',
                                                selected: @js(request()->input('empresa_id', [])),
                                                options: @js(array_keys($empresas->toArray())),
                                                labels: @js($empresas->toArray()),
                                                toggle(option) {
                                                    if (this.selected.includes(option)) {
                                                        this.selected = this.selected.filter(o => o !== option);
                                                    } else {
                                                        this.selected.push(option);
                                                    }
                                                }
                                            }"
                                        >
                                            <!-- Select-style Button -->
                                            <button type="button" @click="open = !open"
                                                class="flex items-center justify-between w-full h-[40px] rounded-full border-2 border-white bg-black_transp text-white px-4 cursor-pointer">
                                                <span class="truncate w-full text-left" 
                                                    x-text="selected.length > 0 ? selected.map(k => labels[k]).join(', ') : 'Empresa'"></span>
                                                <svg class="w-4 h-4 ml-2 transform transition-transform" 
                                                    :class="{ 'rotate-180': open }" 
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown -->
                                            <div x-show="open" x-transition @click.away="open = false"
                                                class="absolute z-50 mt-2 w-full bg-black_transp border border-white text-white rounded-xl shadow-lg">
                                                
                                                <!-- Search input -->
                                                <div class="px-3 py-2 border-b border-white flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l7-7-7-7" />
                                                    </svg>
                                                    <input
                                                        x-model="search"
                                                        type="text"
                                                        placeholder="Buscar empresa..."
                                                        class="w-full bg-transparent text-white placeholder-white outline-none"
                                                        autocomplete="off"
                                                    >
                                                </div>

                                                <!-- Options -->
                                                <ul class="max-h-40 overflow-y-auto px-2">
                                                    <template x-for="option in options.filter(o => labels[o].toLowerCase().includes(search.toLowerCase()))" :key="option">
                                                        <li @click.stop="toggle(option)" class="flex items-center gap-2 px-2 py-2 cursor-pointer hover:bg-gray-700 rounded">
                                                            <input type="checkbox" :checked="selected.includes(option)" class="form-checkbox text-white bg-transparent border-white rounded-sm">
                                                            <span x-text="labels[option]"></span>
                                                        </li>
                                                    </template>
                                                    <li x-show="options.filter(o => labels[o].toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-2 text-gray-400">
                                                        No hay coincidencias
                                                    </li>
                                                </ul>

                                                <!-- Apply Button -->
                                                <div class="border-t border-white px-4 py-2 text-right">
                                                    <button type="submit"
                                                        class="text-sm bg-white text-black font-semibold px-3 py-1 rounded-full hover:bg-gray-200 transition">
                                                        Aplicar
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Hidden Inputs -->
                                            <template x-for="value in selected" :key="value">
                                                <input type="hidden" name="empresa_id[]" :value="value">
                                            </template>
                                        </div>

                                        <!-- ❌ Cancel button -->
                                        <button type="button" @click="toggleFilter('empresa_id')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow hover:bg-red-700 transition">
                                            &times;
                                        </button>
                                    </div>
                                </template>
                            </form>
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
                    <button id="toggleView" onclick="toggleLayout()" class="w-10 h-10 px-2 rounded-full bg-white text-blue border border-blue flex items-center justify-center hover:bg-blue hover:text-white transition">
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
                                        class="text-sm font-semibold shadow-sm rounded-full w-[120px] px-2 py-1 cursor-pointer transition-all
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

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
