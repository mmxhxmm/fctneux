<x-app-layout>
    <div class="w-full flex flex-col bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[350px] mb-10 flex-grow-0 flex-shrink-0" style="background-image: url('../images/personalactivo.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <!-- <div class="absolute inset-0 bg-primary opacity-40"></div> -->

            <!-- Main Heading and Buttons -->
            <div class="bg-black_transp h-16 relative flex justify-between items-center px-10 w-full">
                <!-- Left buttons (Añadir and Eliminar) -->
            <div class="flex items-center">
                    <!-- Añadir button -->
                    @if (Auth::user()->role == 'registrador')
                    <div></div>
                    @else 
                    <div class="w-[110px] h-10">
                        <button id="openModal" class="bg-orange rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                            <p class="text-white text-base font-bold">+ Añadir</p>
                        </button>
                    </div>
                    
                    @endif


                    @include("pages.user.partials.user-form")
                </div>

                <!-- Right Section (Filter, Barcelona / BCN, Situación, and Search) -->
                <div class="flex items-center space-x-4">
                    <select id="filter_municipio" class="bg-black_transp rounded-[100px] border-2 border-white w-[200px] h-[40px] flex items-center pl-4 pr-2 text-white font-roboto text-base font-medium" onchange="filterUsers()">
                        <option value="all">Municipio</option>
                        <option value="barcelona">Barcelona / BCN</option>
                        <option value="madrid">Madrid / Mad</option>
                        <option value="valencia">Valencia / Val</option>
                    </select>

                    <!-- Search Section -->
                    <form action="{{ route('user.search') }}" method="GET" class="relative">
                        <div class="bg-black_transp w-[250px] h-[40px] rounded-full border-2 border-white flex items-center px-4">
                            <input
                                type="text"
                                name="search"
                                placeholder="Buscar usuario"
                                value="{{ request('search') }}"
                                class="bg-transparent border border-transparent focus:outline-none placeholder-white text-white text-sm font-medium w-full outline-none"
                            />
                            <button type="submit" class="ml-2 focus:outline-none">
                                <img class="w-5 h-5" src="../images/svg-buscar.svg" alt="Buscar" />
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

            <div class="w-full h-full flex flex-col absolute px-4">
                <div class="absolute left-0 top-[4em] animate-left">
                    <a href="/" class="p-2 hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6"><<< Volver al inicio</a>
                </div>
                <div class="absolute right-0 top-[7em] animate-right">
                    <a href="{{ $state == 'activo' ? route('user.no_active') : route('user.active') }}" class="hover:text-white hover:border-none justify-end px-4 rounded-tl-[0px] rounded-tl-[50px] rounded-bl-[50px] rounded-bl-[0px] px-4 bg-blue w-[220px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 flex justify-end items-center">
                        Usuarios {{ $state == 'activo' ? 'No Activos' : 'activos'}} >>>
                    </a>
                </div>

                <div class="text-center justify-center mt-14 fade-in">
                    <p class="text-white text-three" style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Personal 
                        <span class="text-two font-roboto_condensed_bold text-orange">
                            {{ $state == 'activo' ? 'Activo' : 'No Activo' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- User Cards Section -->
        <div class="flex justify-center bg-white items-center" id="userGrid">
            <div id="userContainer" class="grid grid-cols-3 gap-6 px-6">
                <!-- Display first 9 users by default -->
                @foreach ($users as $key => $user)
                    <x-index.personal :user="$user"></x-index-box>
                @endforeach
            </div>
            <!-- User List View -->
            <div id="userList" class="hidden w-[90%] px-5 py-6 transition-all">
                <div class="overflow-x-auto bg-white rounded-xl shadow-md border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 text-sm font-roboto">
                        <thead class="bg-blue text-white rounded-t-xl">
                            <tr>
                                <th class="p-4 text-left font-semibold">Nombre</th>
                                <th class="p-4 text-left font-semibold">Email</th>
                                <th class="p-4 text-left font-semibold">Telefono</th>
                                <th class="p-4 text-left font-semibold">Situacion</th>
                                <th class="p-4 text-left font-semibold">Municipio</th>
                                <th class="p-4 text-left font-semibold">Role</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($users as $key => $user)
                                <tr class="hover:bg-blue/5 transition-all">
                                    <td class="p-4 text-gray-800">{{ $user->name }}</td>
                                    <td class="p-4 text-gray-800">{{ $user->email }}</td>
                                    <td class="p-4 text-gray-800">{{ $user->telefono }}</td>
                                    @php
                                        $statusClass = match($user->situacion) {
                                            'alta' => ' text-green-700',
                                            'baja' => 'text-red-700',
                                            default => 'text-gray-700',
                                        };
                                    @endphp
                                    <td class="p-4 text-gray-800 {{ $statusClass }}">{{ ucfirst($user->situacion) }}</td>
                                    <td class="p-4 text-gray-800">{{ ucfirst($user->municipio) }}</td>
                                    <td class="p-4 text-gray-800">{{ ucfirst($user->role) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Hidden Users Section (Initially hidden) -->
        <div id="hiddenUsers" class="hidden mt-6">
            <div class="flex justify-center bg-white items-center">
                <div class="grid grid-cols-3 gap-6">
                    @foreach ($users as $key => $user)
                        <x-index.personal :user="$user"></x-index-box>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="relative h-[420px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/personalbottom.png'); background-size: cover; background-position: center;">
            <!-- Button is absolutely positioned in the center of the image -->
            <!-- <div class="absolute inset-0 flex justify-center items-center">
                <button class="p-4 bg-blue rounded-lg text-white w-[120px]">Ver todos</button>
            </div> -->
        </div>
    </div>

    <!-- JavaScript to toggle visibility -->
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            filterUsers();
        });

        // function toggleUserVisibility() {
        //     const hiddenUsers = document.querySelector('#hiddenUsers');
        //     const button = document.querySelector('#see-more');

        //     // Toggle hidden users visibility
        //     if (hiddenUsers.classList.contains('hidden')) {
        //         hiddenUsers.classList.remove('hidden');
        //         button.innerText = 'Ver menos';
        //     } else {
        //         hiddenUsers.classList.add('hidden');
        //         button.innerText = 'Ver todos';
        //     }
        // }

        // Function to filter users based on selected municipio and situacion
        function filterUsers() {
            const selectedMunicipio = document.querySelector('#filter_municipio').value.toLowerCase();
            const userCards = document.querySelectorAll('.user-card');

            userCards.forEach(card => {
                const municipio = card.getAttribute('data-municipio');
                
                if (selectedMunicipio === 'all' || municipio === selectedMunicipio) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Get the modal, open button, and close button
        const modal = document.getElementById("myModal");
        const openModalBtn = document.getElementById("openModal");

        // Close modal
        document.querySelectorAll('.closeModal').forEach(button => {
            button.addEventListener('click', function() {
                modal.classList.add("hidden");
            });
        });

        // Open modal
        openModalBtn.onclick = function() {
            modal.classList.remove("hidden");
        };

        // Close modal if clicked outside the modal content
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.classList.add("hidden");
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
            const grid = document.getElementById('userContainer');
            const list = document.getElementById('userList');
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
</x-app-layout>
