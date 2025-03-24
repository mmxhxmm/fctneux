<x-app-layout>
    <div class="w-full flex flex-col bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[450px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/personalactivo.png'); background-size: cover; background-position: center;">
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

            <!-- The Modal -->
            <div id="myModal" class="fixed inset-0 flex bg-black bg-opacity-50 hidden justify-center items-center z-50">
                <div class="bg-white border-2 border-blue w-[60%] h-auto rounded-lg">
                    <div class="relative">
                        <div class="bg-blue text-white text-center p-2 text-four">Datos de Usuarios</div>
                        <div class="p-16 text-blue flex justify-center items-center">
                            <form action="" class="w-full max-w-3xl">
                                <!-- First Row -->
                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="nif-personal" class="block w-[200px] pb-3">NIF</label>
                                        <input type="text" name="nif-personal" maxlength="9" required class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                    <div class="flex-1">
                                        <label for="nivel-personal" class="block w-[200px] pb-3">Nivel de acceso</label>
                                        <select name="nivel-personal" id="nivel-personal" class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                            <option value="Coodinador">Coordinador</option>
                                            <option value="Registrador">Registrador</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Second Row -->
                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="nombre-personal" class="block w-[200px] pb-3">Nombre</label>
                                        <input type="text" name="nombre-personal" required class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                    <div class="flex-1">
                                        <label for="apellido-personal" class="block w-[200px] pb-3">Apellido</label>
                                        <input type="text" name="apellido-personal" class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                </div>

                                <!-- Third Row -->
                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="correo-personal" class="block w-[200px] pb-3">Correo Electronico</label>
                                        <input type="email" name="correo-personal" class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                    <div class="flex-1">
                                        <label for="tel-personal" class="block w-[200px] pb-3">Teléfono</label>
                                        <input type="tel" name="tel-personal" maxlength="9" class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                </div>

                                <!-- Fourth Row -->
                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="municipio-personal" class="block w-[200px] pb-3">Municipio</label>
                                        <input type="text" name="municipio-personal" class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                    <div class="flex-1">
                                        <label for="situacion-personal" class="block w-[200px] pb-3">Situación</label>
                                        <select name="situacion-personal" id="situacion-personal" class="ml-2 rounded-lg w-auto mb-4 border-2 border-blue">
                                            <option value="Alta">Alta</option>
                                            <option value="Baja">Baja</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Buttons Section -->
                                <div class="flex gap-6 mt-4 justify-end">
                                    <button type="submit" class="bg-blue text-white p-3 px-6 rounded-lg">Guardar</button>
                                    <button type="button" class="bg-orange text-white p-3 px-6 rounded-lg">Eliminar</button>
                                </div>
                            </form>
                        </div>

                        <!-- Close Button -->
                         
                        <button id="closeModal" class="absolute top-0 w-10 h-10 right-0 bg-orange text-white rounded-[100px] m-2">X</button>
                    </div>
                </div>
            </div>
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

                </script>
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
                        Usuarios {{ $state == 'activo' ? 'No Activos' : 'activos'}} >>>
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
                    <x-index.personal :user="$user"></x-index-box>
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
                            <x-index.personal :user="$user"></x-index-box>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="relative h-[420px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/personalbottom.png'); background-size: cover; background-position: center;">
            <!-- Button is absolutely positioned in the center of the image -->
            <div class="absolute inset-0 flex justify-center items-center">
                <button id="see-more" class="p-4 bg-blue rounded-lg text-white w-[120px]"  onclick="toggleUserVisibility()">Ver todos</button>
            </div>
        </div>
    </div>

    <!-- JavaScript to toggle visibility -->
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            filterUsers();
        });

        function toggleUserVisibility() {
            const hiddenUsers = document.querySelector('#hiddenUsers');
            const button = document.querySelector('#see-more');

            // Toggle hidden users visibility
            if (hiddenUsers.classList.contains('hidden')) {
                hiddenUsers.classList.remove('hidden');
                button.innerText = 'Ver menos';
            } else {
                hiddenUsers.classList.add('hidden');
                button.innerText = 'Ver todos';
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
