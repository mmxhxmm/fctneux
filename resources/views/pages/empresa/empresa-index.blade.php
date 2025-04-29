<x-app-layout>
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[400px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/bg-fct.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <!-- <div class="absolute inset-0 bg-primary opacity-40"></div> -->
            
            <!-- Main Heading and Buttons -->
            <div class="bg-black_transp h-16 relative flex justify-between items-center px-10 w-full">
                <!-- Left buttons (Añadir and Eliminar) -->
                <div class="h-10 flex items-center space-x-4">
                    <!-- Añadir button -->
                    <div class="flex items-center justify-center space-x-4">
                        <a href="{{ route('empresa-form-1') }}" class="px-7 bg-orange rounded-full h-10 flex justify-center items-center text-center">
                            <p class="text-white text-base font-bold">
                                + Añadir
                            </p>
                        </a>
                        
                        @if(session()->has('empresa_draft'))
                        <div class="flex items-center gap-2 bg-[#1c3b5c]/80 text-white text-sm rounded-full px-4 py-1.5 shadow-sm backdrop-blur-sm border border-white/10">
                            <a href="{{ route('empresa-form-1') }}"
                            class="ml-2 text-sm font-semibold text-white hover:text-blue-300 transition duration-200 no-underline hover:underline hover:underline-offset-2">
                                <svg class="w-4 h-4 inline mr-1 text-blue-200" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2l4 -4m6 2a10 10 0 11-20 0a10 10 0 0120 0z" />
                                </svg>
                                <span>Borrador guardado</span>
                            </a>
                        </div>

                        @endif
                    </div>
                </div>
                <!-- Toggle View Button -->
                <div class="flex items-center space-x-4">
                
                </div>

                <!-- Right Section (Filter, Barcelona / BCN, and Search) -->
                <div class="flex items-center space-x-4">
                    <!-- Filter Section -->
                    <!-- Dropdown to select filters -->
                    <div class="relative inline-block w-full">
                        <div 
                            x-data="{
                                open: false,
                                selectedFilters: [
                                    'provincia', 
                                    {{ request('modalidad') ? "'modalidad'," : '' }}
                                    {{ request('colaboracion') ? "'colaboracion'," : '' }}
                                    {{ request('ciclo') ? "'ciclo'," : '' }}
                                    {{ request('plazas') ? "'plazas'," : '' }}
                                    {{ request('familia') ? "'familia'," : '' }}
                                ],
                                toggleFilter(type) {
                                    if (this.selectedFilters.includes(type)) {
                                        this.selectedFilters = this.selectedFilters.filter(f => f !== type);
                                        if (this.selectedFilters.length === 0) {
                                            window.location.href = '{{ route("empresa-index") }}'; // redirect when none selected
                                        }
                                    } else {
                                        this.selectedFilters.push(type);
                                    }
                                }
                            }"
                            class="w-full flex items-center flex-wrap"
                        >
                            <!-- Dropdown Filter Trigger -->
                            <div class="relative">
                                <select 
                                    @change="toggleFilter($event.target.value); $event.target.value=''" 
                                    class="bg-black_transp w-[109px] text-white font-roboto text-base hover:text-white font-medium rounded-[100px] border-2 border-white w-[200px] h-[40px] px-4 pr-10 appearance-none cursor-pointer"
                                >
                                    <option value="">+ Filtro</option>
                                    <option value="modalidad" :disabled="selectedFilters.includes('modalidad')">Modalidad</option>
                                    <option value="colaboracion" :disabled="selectedFilters.includes('colaboracion')">Colaboración</option>
                                    <option value="ciclo" :disabled="selectedFilters.includes('ciclo')">Ciclo</option>
                                    <option value="plazas" :disabled="selectedFilters.includes('plazas')">Plazas</option>
                                    <option value="familia" :disabled="selectedFilters.includes('familia')">Familia</option>
                                    <option value="provincia" :disabled="selectedFilters.includes('provincia')">Provincia</option>
                                </select>
                            </div>

                            <!-- Selected Filters Form -->
                            <form method="GET" action="{{ route('empresa.filtro') }}" class="flex flex-wrap ml-4 items-center gap-3">

                                <!-- Modalidad -->
                                <template x-if="selectedFilters.includes('modalidad') || '{{ request('modalidad') }}' !== ''">
                                    <div class="relative inline-block">
                                        <select name="modalidad" onchange="this.form.submit()" class="w-[140px] rounded-full border-2 border-white bg-black_transp text-white px-4 py-2 pr-10">
                                            <option value="" class="bg-stone-700 text-white">Modalidad</option>
                                            @foreach ($modalidades as $value => $label)
                                                <option value="{{ $value }}" {{ request('modalidad') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" @click="toggleFilter('modalidad')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow-lg hover:bg-red-700 transition">&times;</button>
                                    </div>
                                </template>


                                <!-- Colaboración -->
                                <template x-if="selectedFilters.includes('colaboracion') || '{{ request('colaboracion') }}' !== ''">
                                    <div class="relative inline-block">
                                        <select name="colaboracion" onchange="this.form.submit()" class="w-[150px] rounded-full border-2 border-white bg-black_transp text-white px-4 py-2 pr-10">
                                            <option value="" class="bg-stone-700 text-white">Selecciona</option>
                                            @foreach ($colaboraciones as $value => $label)
                                                <option value="{{ $value }}" {{ request('colaboracion') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" @click="toggleFilter('colaboracion')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow-lg hover:bg-red-700 transition">&times;</button>
                                    </div>
                                </template>


                                <!-- Ciclo -->
                                <template x-if="selectedFilters.includes('ciclo') || '{{ request('ciclo') }}' !== ''">
                                    <div class="relative inline-block">
                                        <select name="ciclo" onchange="this.form.submit()" class="w-[100px] rounded-full border-2 border-white bg-black_transp text-white px-4 py-2 pr-10">
                                            <option value="" class="bg-stone-700 text-white">Ciclo</option>
                                            @foreach ($ciclos as $value => $label)
                                                <option value="{{ $value }}" {{ request('ciclo') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" @click="toggleFilter('ciclo')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow-lg hover:bg-red-700 transition">&times;</button>
                                    </div>
                                </template>

                                <!-- Plazas -->
                                <template x-if="selectedFilters.includes('plazas') || '{{ request('plazas') }}' !== ''">
                                    <div class="relative inline-block">
                                        <select name="plazas" onchange="this.form.submit()" class="w-[160px] rounded-full border-2 border-white bg-black_transp text-white px-4 py-2 pr-10">
                                            <option value="" class="bg-stone-700 text-white">Plazas</option>
                                            <option value="0" {{ request('plazas') == '0' ? 'selected' : '' }}>0</option>
                                            <option value="lt5" {{ request('plazas') == 'lt5' ? 'selected' : '' }}>Menor de 5</option>
                                            <option value="gt5" {{ request('plazas') == 'gt5' ? 'selected' : '' }}>Más de 5</option>
                                            <option value="gt10" {{ request('plazas') == 'gt10' ? 'selected' : '' }}>Más de 10</option>
                                        </select>
                                        <button type="button" @click="toggleFilter('plazas')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow-lg hover:bg-red-700 transition">&times;</button>
                                    </div>
                                </template>

                                <!-- Familia -->
                                <template x-if="selectedFilters.includes('familia') || '{{ request('familia') }}' !== ''">
                                    <div class="relative inline-block">
                                        <select name="familia" onchange="this.form.submit()" class="w-[111px] rounded-full border-2 border-white bg-black_transp text-white px-4 py-2 pr-10">
                                            <option value="" class="bg-stone-700 text-white">Familia</option>
                                            @foreach ($familias as $value => $label)
                                                <option value="{{ $value }}" {{ request('familia') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" @click="toggleFilter('familia')" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow-lg hover:bg-red-700 transition">&times;</button>
                                    </div>
                                </template>

                                <!-- Provincia -->
                                <template x-if="selectedFilters.includes('provincia') || '{{ request('provincia') }}' !== ''">
                                    <div class="relative inline-block">
                                        <select name="provincia" onchange="this.form.submit()" class="w-[160px] rounded-full border-2 border-white bg-black_transp text-white px-4 py-2 pr-10">
                                            <option value="" class="bg-stone-700 text-white">Provincia</option>
                                            @foreach ($provincia as $value => $label)
                                                <option value="{{ $value }}" {{ request('provincia') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </template>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('empresa-index-3') }}" method="GET" class="relative">
                        <div class="bg-black_transp w-[200px] h-[40px] rounded-[100px] border-2 border-white flex items-center pl-4 pr-2">
                            <input
                                type="text"
                                name="search"
                                placeholder="Buscar empresa"
                                class="bg-transparent border-none rounded-[100px] text-white text-xs font-medium outline-none w-full"
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

            <div class="w-full h-full flex flex-col  absolute px-4 ">
                <div class="absolute left-0 top-[4em] animate-left">
                    <a href="/" class="justify-start p-2 px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] hover:text-white hover:border-none text-[16px] text-white text-left flex-grow-0 mb-6 "><<< Volver al inicio</a>
                    <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] hover:text-white hover:border-none text-[16px] text-white text-left font-roboto flex-grow-0 mb-6 ">
                        {{ __('<<< Volver al inicio') }}
                    </x-nav-link> -->
                </div>

                <div class="absolute left-0 top-[7em] animate-left2">
                    <button class="justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-blue w-[210px] h-[40px] text-[15px] text-white text-left flex-grow-0">
                        <a href="https://www.empresaiformacio.org/sBid" ><<< Plataforma de qBid</a> 
                    </button>
                </div>

                <div class="text-center justify-center mt-10 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Plataforma de <span class="text-two font-roboto_condensed_bold tracking-wide text-orange">Empresas</span>
                    </p>
                </div>
            </div>

            <!-- Status Banner (appears under header) -->
            @if (session('status'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="absolute top-4 left-[30.5%] transform -translate-x-1/2 z-50 bg-green-600 text-white px-2 py-1.5 rounded-full shadow-lg text-sm flex items-center gap-3"
                role="alert"
            >
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2l4 -4m6 2a10 10 0 11-20 0a10 10 0 0120 0z" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        </div>

        <div class="flex px-6 justify-center bg-white items-center">
            <!-- Empresa Grid (default view) -->
            <div id="empresaContainer" class="grid grid-cols-3 gap-6 transition-all">
                @foreach ($empresas as $empresa)
                    <x-index.empresa :empresa="$empresa" />
                @endforeach
            </div>
            <!-- Empresa List View -->
            <div id="empresaList" class="hidden w-[80%] px-5 py-6 transition-all">
                <div class="overflow-x-auto bg-white rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 text-sm font-roboto">
                        <thead class="bg-blue text-white rounded-t-xl">
                            <tr>
                                <th class="p-4 text-left font-semibold">Nombre</th>
                                <th class="p-4 text-left font-semibold">CIF</th>
                                <th class="p-4 text-left font-semibold">Gestiones</th>
                                <th class="p-4 text-left font-semibold">Modalidad</th>
                                <th class="p-4 text-left font-semibold">Colaboración</th>
                                <th class="p-4 text-left font-semibold">Familia</th>
                                <th class="p-4 text-left font-semibold">Provincía</th>
                                <th class="p-4 text-left font-semibold">Ciclo Formativo</th>
                                <th class="p-4 text-left font-semibold text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($empresas as $empresa)
                                @if (!request('provincia') || strtolower($empresa->provincia) == strtolower(request('provincia')))
                                <tr class="hover:bg-blue/5 transition-all">
                                    <td class="p-4 text-gray-800">{{ $empresa->nombre }}</td>
                                    <td class="p-4 text-gray-800">{{ $empresa->cif }}</td>
                                    <td class="p-4 text-gray-800">{{ $empresa->gestiones }}</td>
                                    <td class="p-4 text-gray-800">{{ $empresa->modalidad }}</td>
                                    <td class="p-4">
                                        <span class="text-xs font-medium px-3 py-1 rounded-full 
                                            {{ 
                                                $empresa->colaboracion === 'Prospección' ? 'bg-blue/10 text-blue' :
                                                ($empresa->colaboracion === 'Inactiva' ? 'bg-red-100 text-red-600' :
                                                'bg-green-100 text-green-600') 
                                            }}">
                                            {{ $empresa->colaboracion }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-800">{{ $empresa->familiaPersonal }}</td>
                                    <td class="p-4 text-gray-800">{{ $empresa->provincia }}</td>
                                    <td class="p-4 text-gray-800 whitespace-pre-wrap">
                                        @foreach ($empresa->practica as $practica)
                                            • {{ $practica->cicloFormativo }} ({{ $practica->numPlazasAsignadas }} plazas)<br>
                                        @endforeach
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('empresa-detail', ['id' => $empresa->id]) }}" class="inline-block bg-blue text-white px-4 py-2 rounded-full text-xs font-medium hover:bg-blue/90 transition">
                                            Ver más
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="relative h-[420px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/bottom.png'); background-size: cover; background-position: center;">
            <!-- Button is absolutely positioned in the center of the image -->
            <!-- <div class="absolute inset-0 flex justify-center items-center">
                <button class="p-4 bg-blue rounded-lg text-white w-[120px]">Ver todos</button>
            </div> -->
        </div>
    </div>

    <!-- JavaScript (for Search functionality) -->
    <script>

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
            const grid = document.getElementById('empresaContainer');
            const list = document.getElementById('empresaList');
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


    </script>
    
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .animate-left {
            opacity: 0;
            transform: translateX(-100%);
            animation: slideInLeft 1s forwards;
        }

        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-left2 {
            opacity: 0;
            transform: translateX(-100%);
            animation: slideInLeft 1.5s forwards;
        }

        @keyframes slideInLeft {
            0% {
                opacity: 0;
                transform: translateX(-100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</x-app-layout>
