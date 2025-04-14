<x-app-layout>
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[350px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/tareasheader.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <!-- <div class="absolute inset-0 bg-primary opacity-40"></div> -->
            
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
                                                <option value="pendiente">Pendiente</option>
                                                <option value="hecho">Hecho</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="desc-tarea" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                                            <textarea name="desc-tarea" id="desc-tarea" rows="3"
                                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue"></textarea>
                                        </div>

                                        <div>
                                            <label for="asig-tarea" class="block text-sm font-medium text-gray-700 mb-1">Asignado a</label>
                                            <input type="text" name="asig-tarea" id="asig-tarea"
                                                class="w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-blue focus:border-blue">
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

                    <!-- Barcelona / BCN Dropdown -->
                    <select class="bg-black_transp rounded-[100px] border-2 border-white w-[200px] h-[40px] flex items-center pl-4 pr-2 text-white font-roboto text-base font-medium">
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
                                class="bg-transparent border border-transparent border-none rounded-[100px] text-white font-roboto text-xs font-medium outline-none w-full"
                                onkeyup="handleSearch()"
                            />
                            <!-- Search Icon -->
                            <img class="w-[20px] h-[20px]" src="../images/svg-buscar.svg" alt="Search Icon" />
                        </div>
                    </div>
                </div>
            </div>




            <div class="w-full h-full flex flex-col  absolute px-4">
                <div class="absolute left-0 top-[4em] animate-left">
                    <a href="/" class="p-2 hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6"><<< Volver al inicio</a>
                    <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6">
                        {{ __('<<< Volver al inicio') }}
                    </x-nav-link> -->
                </div>
                <div class="absolute left-0 top-[7em] animate-left2">
                    <a href="{{ route('tareas-index') }}"  class="hover:text-white hover:border-none rounded-tl-[0px] rounded-tr-[50px] px-4 rounded-br-[50px] rounded-bl-[0px] bg-blue w-[200px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex justify-start items-center"><<< Tareas pendientes</a>
                <!-- <x-nav-link :href="route('tareas-index')" :active="request()->routeIs('tareas-index')" 
                    class="hover:text-white hover:border-none rounded-tl-[0px] rounded-tr-[50px] px-4 rounded-br-[50px] rounded-bl-[0px] bg-blue w-[200px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex justify-start items-center">
                    {{ __('<<< Tareas pendientes') }}
                </x-nav-link> -->
            </div>

                <div class="text-center justify-center mt-12 fade-in ">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Historial de <span class="text-two font-roboto_condensed_bold text-orange">Tareas</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-center bg-white items-center">
            <div class="grid grid-cols-3 gap-6">
                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 1</div>
                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 2</div>
                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 3</div>

                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 4</div>
                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 5</div>
                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 6</div>

                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 7</div>
                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 8</div>
                <div class="w-[342px] h-[400px] flex-grow-0 opacity-90 border border-[#b7b7b7] bg-white">Block 9</div>
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
        function handleSearch() {
            const searchText = document.getElementById('searchInput').value;
            console.log('Search Term:', searchText); // Logs the search term for debugging purposes
            // You can add additional logic here to filter or display search results on the page
        }

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

</x-app-layout>
