<x-app-layout>
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[450px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/bg-fct.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <!-- <div class="absolute inset-0 bg-primary opacity-40"></div> -->
            
            <!-- Main Heading and Buttons -->
            <div class="bg-black_transp h-16 relative flex justify-between items-center px-10 w-full">
                <!-- Left buttons (Añadir and Eliminar) -->
                <div class="h-10 flex items-center space-x-4">
                    <!-- Añadir button -->
                    <div class="flex items-center justify-center space-x-4">
                        <a href="{{ route('empresa-form-1') }}" class="px-7 bg-[#ff8300] rounded-full h-10 flex justify-center items-center text-center">
                            <p class="text-white text-base font-bold">
                                + Añadir
                            </p>
                        </a>
                        
                        @if(session()->has('empresa_draft'))
                            <p class="text-white"><- [Tienes un Draft Guardado]</p>
                        @endif
                    </div>
                </div>
                <!-- Toggle View Button -->
                <div class="flex items-center space-x-4">
                    
                </div>


                <!-- Right Section (Filter, Barcelona / BCN, and Search) -->
                <div class="flex items-center space-x-4">
                    <!-- Filter Section -->
                    <div class="relative">
                        <div class="bg-black_transp w-[200px] h-[40px] rounded-[100px] border-2 border-white flex items-center pl-4 pr-2">
                            <img class="w-[20px] h-[20px]" src="../images/filter-svg.svg" alt="Filter Icon" />
                            <div class="text-white text-base font-medium ml-2">
                                Filter
                            </div>
                        </div>
                    </div>

                    <!-- Provincias Dropdown -->
                    <select class="bg-black_transp rounded-[100px] border-2 border-white w-[200px] h-[40px] flex items-center pl-4 pr-2 text-white font-roboto text-base font-medium">
                        <option value="todos">Todos</option>
                        <option value="alava">Álava</option>
                        <option value="albacete">Albacete</option>
                        <option value="alicante">Alicante</option>
                        <option value="almeria">Almería</option>
                        <option value="asturias">Asturias</option>
                        <option value="avila">Ávila</option>
                        <option value="badajoz">Badajoz</option>
                        <option value="barcelona">Barcelona</option>
                        <option value="burgos">Burgos</option>
                        <option value="caceres">Cáceres</option>
                        <option value="cadiz">Cádiz</option>
                        <option value="cantabria">Cantabria</option>
                        <option value="castellon">Castellón</option>
                        <option value="ceuta">Ceuta</option>
                        <option value="cordoba">Córdoba</option>
                        <option value="cuenca">Cuenca</option>
                        <option value="girona">Girona</option>
                        <option value="granada">Granada</option>
                        <option value="guadalajara">Guadalajara</option>
                        <option value="girona">Girona</option>
                        <option value="huelva">Huelva</option>
                        <option value="huesca">Huesca</option>
                        <option value="jaen">Jaén</option>
                        <option value="la-coruna">La Coruña</option>
                        <option value="la-rioja">La Rioja</option>
                        <option value="las-palmas">Las Palmas</option>
                        <option value="leon">León</option>
                        <option value="lleida">Lleida</option>
                        <option value="lugo">Lugo</option>
                        <option value="madrid">Madrid</option>
                        <option value="malaga">Málaga</option>
                        <option value="melilla">Melilla</option>
                        <option value="murcia">Murcia</option>
                        <option value="navarra">Navarra</option>
                        <option value="orense">Ourense</option>
                        <option value="palencia">Palencia</option>
                        <option value="pontevedra">Pontevedra</option>
                        <option value="salamanca">Salamanca</option>
                        <option value="segovia">Segovia</option>
                        <option value="sevilla">Sevilla</option>
                        <option value="soria">Soria</option>
                        <option value="tarragona">Tarragona</option>
                        <option value="teruel">Teruel</option>
                        <option value="toledo">Toledo</option>
                        <option value="valencia">Valencia</option>
                        <option value="valladolid">Valladolid</option>
                        <option value="vizcaya">Vizcaya</option>
                        <option value="zamora">Zamora</option>
                        <option value="zaragoza">Zaragoza</option>
                    </select>

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


                    <button id="toggleView" onclick="toggleLayout()" class="w-10 h-10 rounded-full bg-white text-blue border border-blue flex items-center justify-center hover:bg-blue hover:text-white transition">
                        <!-- Grid Icon -->
                        <svg id="iconGrid" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h4v4H4V6zM10 6h4v4h-4V6zM16 6h4v4h-4V6zM4 12h4v4H4v-4zM10 12h4v4h-4v-4zM16 12h4v4h-4v-4z"/>
                        </svg>

                        <!-- List Icon (initially hidden) -->
                        <svg id="iconList" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="w-full h-full flex flex-col  absolute px-4 ">
                <div class="absolute left-0 top-[6em] animate-left">
                    <a href="/" class="justify-start p-2 px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] hover:text-white hover:border-none text-[16px] text-white text-left flex-grow-0 mb-6 "><<< Volver al inicio</a>
                    <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] hover:text-white hover:border-none text-[16px] text-white text-left font-roboto flex-grow-0 mb-6 ">
                        {{ __('<<< Volver al inicio') }}
                    </x-nav-link> -->
                </div>

                <div class="absolute left-0 top-[10em] animate-left2">
                    <button class="justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-blue w-[210px] h-[40px] opacity-90 text-[15px] text-white text-left flex-grow-0">
                        <a href="https://www.empresaiformacio.org/sBid" ><<< Plataforma de qBid</a> 
                    </button>
                </div>

                <div class="text-center justify-center mt-20 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Plataforma de <span class="text-two font-roboto_condensed_bold text-orange">Empresas</span>
                    </p>
                </div>
            </div>
            <!-- Status Banner (appears under header) -->
            @if (session('status'))
            <div 
                x-data="{ show: true }" 
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 5000)"
                class="bg-transparent border border-transparent border-none rounded-[100px] text-white font-roboto text-xs font-medium outline-none w-full"
            >
                {{ session('status') }}
            </div>
            @endif
        </div>

        <div class="flex justify-center bg-white items-center">
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
                            <th class="p-4 text-left font-semibold">Municipio</th>
                            <th class="p-4 text-left font-semibold">Ciclo Formativo</th>
                            <th class="p-4 text-left font-semibold text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($empresas as $empresa)
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
                                <td class="p-4 text-gray-800">{{ $empresa->municipio }}</td>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        </div>
        <div class="relative h-[420px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/bottom.png'); background-size: cover; background-position: center;">
            <!-- Button is absolutely positioned in the center of the image -->
            <div class="absolute inset-0 flex justify-center items-center">
                <button class="p-4 bg-blue rounded-lg text-white w-[120px]">Ver todos</button>
            </div>
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
            const iconGrid = document.getElementById('iconGrid');
            const iconList = document.getElementById('iconList');

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
