<x-app-layout>
    <div class="w-full flex flex-col bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[450px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/personalactivo.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <!-- <div class="absolute inset-0 bg-primary opacity-40"></div> -->

            <!-- Main Heading and Buttons -->
            <div class="bg-black_transp h-16 relative flex justify-between items-center px-10 w-full">
                <!-- Left buttons (Añadir and Eliminar) -->
                <div class="flex items-center space-x-4">
                    <!-- Añadir button -->
                    <div class="w-[110px] h-10">
                        <div class="bg-[#ff8300] rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                            <a href="datos-personal">
                                <button class="text-white font-roboto text-base font-bold">+ Añadir</button>
                            </a>
                        </div>
                    </div>

                    <!-- Eliminar button -->
                    <!-- <div class="w-[110px] h-10">
                        <div class="bg-[#002f86] rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                            <button class="text-white font-roboto text-base font-bold">- Eliminar</button>
                        </div>
                    </div> -->
                </div>

                <!-- Right Section (Filter, Barcelona / BCN, Situación, and Search) -->
                <div class="flex items-center space-x-4">
                    <!-- Filter Section
                    <div class="relative">
                        <div class="bg-black_transp w-[200px] h-[40px] rounded-[100px] border-2 border-white flex items-center pl-4 pr-2">
                            <img class="w-[20px] h-[20px]" src="../images/filter-svg.svg" alt="Filter Icon" />
                            <div class="text-white font-roboto text-base font-medium ml-2">
                                Filter
                            </div>
                        </div>
                    </div> -->

                    <!-- Barcelona / BCN Dropdown -->
                    <select id="filter_municipio" class="bg-black_transp rounded-[100px] border-2 border-white w-[200px] h-[40px] flex items-center pl-4 pr-2 text-white font-roboto text-base font-medium" onchange="filterUsers()">
                        <option value="all">Municipio</option>
                        <option value="barcelona">Barcelona / BCN</option>
                        <option value="madrid">Madrid / Mad</option>
                        <option value="valencia">Valencia / Val</option>
                    </select>

                    <!-- Search Section -->
                    <div class="relative">
                        <!-- Search Container -->
                        <div class="bg-black_transp w-[200px] h-[40px] rounded-[100px] border-2 border-white flex items-center pl-4 pr-2">
                            <!-- Search Input -->
                            <input
                                type="text"
                                id="searchInput"
                                placeholder="Search"
                                class="bg-transparent border-none rounded-[100px] text-white font-roboto text-xs font-medium outline-none w-full"
                                onkeyup="handleSearch()"
                            />
                            <!-- Search Icon -->
                            <img class="w-[20px] h-[20px]" src="../images/svg-buscar.svg" alt="Search Icon" />
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="w-full h-full flex flex-col absolute px-4">
                <div class="absolute left-0 top-[6em] animate-left">
                    <a href="/" class="p-2 hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6"><<< Volver al inicio</a>
                </div>
                <div class="absolute right-0 top-[10em] animate-right">
                    <a href="{{ $state == 'activo' ? 'personal-no-activo' : 'personal-activo' }}" class="hover:text-white hover:border-none justify-end px-4 rounded-tl-[0px] rounded-tl-[50px] rounded-bl-[50px] rounded-bl-[0px] px-4 bg-blue w-[220px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 flex justify-end items-center">
                        Usuarios {{ $state == 'Activo' ? 'activos' : 'No Activos'}} >>>
                    </a>
                </div>

                <div class="text-center justify-center mt-24 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Personal 
                        <span class="text-three font-roboto_condensed_bold text-orange">
                            {{ $state == 'activo' ? 'Activo' : 'No Activo' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- User Cards Section -->
        <div class="flex justify-center bg-white items-center" id="userGrid">
            <div class="grid grid-cols-3 gap-6">
                <!-- Display first 9 users by default -->
                @foreach ($users as $key => $user)
                    <div class="user-card w-[342px] h-[342px] p-4 flex-grow-0 shadow-lg opacity-90 border-2 border-blue bg-white" data-municipio="{{ strtolower($user->municipio) }}" data-situacion="{{ strtolower($user->situacion) }}">
                        <p class="text-semibold m-4"><b>Nombre: </b>{{ $user->name }}</p>
                        <p class="text-semibold m-4"><b>Correo: </b>{{ $user->email }}</p>
                        <p class="text-semibold m-4 "><b>Telefono: </b>{{ $user->telefono }}</p>
                        <p class="text-semibold m-4">
                            <b>Situación: </b>
                            <span class="{{ $user->situacion == 'Alta' ? 'text-green-500' : ($user->situacion == 'Baja' ? 'text-red-500' : 'text-black') }}">
                                {{ $user->situacion }}
                            </span>
                        </p>
                        <p class="text-semibold m-4"><b>Municipio: </b>{{ $user->municipio }}</p>
                        <p class="text-semibold m-4">
                                    <b>Role: </b>
                                    <span class="{{ $user->role == 'admin' ? 'text-orange' : ($user->role == 'coordinador' ? 'text-blue' : 'text-black') }}">
                                        {{ $user->role }}
                                    </span>
                                </p>
                    </div>
                    @if ($key == 8) <!-- After the 9th user, break the loop -->
                        @break
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Hidden Users Section (Initially hidden) -->
        <div id="hiddenUsers" class="hidden mt-6">
            <div class="flex justify-center bg-white items-center">
                <div class="grid grid-cols-3 gap-6">
                    @foreach ($users as $key => $user)
                        @if ($key > 8) <!-- Only show users after the 9th one -->
                            <div class="user-card w-[342px] h-[342px] p-4 flex-grow-0 shadow-lg opacity-90 border-2 border-blue bg-white" data-municipio="{{ strtolower($user->municipio) }}" data-situacion="{{ strtolower($user->situacion) }}">
                                <p class="text-semibold m-4"><b>Nombre: </b>{{ $user->name }}</p>
                                <p class="text-semibold m-4"><b>Correo: </b>{{ $user->email }}</p>
                                <p class="text-semibold m-4"><b>Telefono: </b>{{ $user->telefono }}</p>
                                <p class="text-semibold m-4">
                                    <b>Situación: </b>
                                    <span class="{{ $user->situacion == 'Alta' ? 'text-green-500' : ($user->situacion == 'Baja' ? 'text-red-500' : 'text-black') }}">
                                        {{ $user->situacion }}
                                    </span>
                                </p>
                                <p class="text-semibold m-4"><b>Municipio: </b>{{ $user->municipio }}</p>
                                <p class="text-semibold m-4">
                                    <b>Role: </b>
                                    <span class="{{ $user->role == 'admin' ? 'text-orange' : ($user->role == 'coordinador' ? 'text-blue' : 'text-black') }}">
                                        {{ $user->role }}
                                    </span>
                                </p>
                                <!-- <p class="text-semibold m-4 text-blue"><b class="text-black">Role: </b>{{ $user->role }}</p> -->
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="relative h-[420px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/personalbottom.png'); background-size: cover; background-position: center;">
            <!-- Button is absolutely positioned in the center of the image -->
            <div class="absolute inset-0 flex justify-center items-center">
                <button class="p-4 bg-blue rounded-lg text-white w-[120px]"  onclick="toggleUserVisibility()">Ver todos</button>
            </div>
        </div>
    </div>

    <!-- JavaScript to toggle visibility -->
    <script>
        function toggleUserVisibility() {
            const hiddenUsers = document.getElementById('hiddenUsers');
            const button = document.querySelector('button');

            // Toggle hidden users visibility
            if (hiddenUsers.classList.contains('hidden')) {
                hiddenUsers.classList.remove('hidden');
                button.innerText = 'Ver menos'; // Change button text to 'Ver menos'
            } else {
                hiddenUsers.classList.add('hidden');
                button.innerText = 'Ver todos'; // Change button text back to 'Ver todos'
            }
        }

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
    </script>
</x-app-layout>
