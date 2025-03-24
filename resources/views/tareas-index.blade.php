<x-app-layout>
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[450px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/tareasheader.png'); background-size: cover; background-position: center;">
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
                                <div class="bg-blue text-white text-center p-2 text-four">Datos de Tareas</div>
                                <div class="p-10 flex justify-between items-start">
                        <div class="w-[45%]">
                            <iframe src="https://calendar.google.com/calendar/embed?src=your-calendar-id&ctz=America%2FNew_York"
                                    width="100%" height="400px" frameborder="0" scrolling="no"></iframe>
                        </div>

                        <div class="w-[50%]">
                            <form id="taskForm" class="w-full">
                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="nombre-tarea" class="block w-[200px] pb-3">Nombre de la tarea</label>
                                        <input type="text" name="nombre-tarea" id="nombre-tarea" required class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                </div>

                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="desc-tarea" class="block w-[200px] pb-3">Descripción</label>
                                        <textarea name="desc-tarea" id="desc-tarea" class="ml-2 rounded-lg w-[70%] border-2 border-blue"></textarea>
                                    </div>
                                </div>

                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="asig-tarea" class="block w-[200px] pb-3">Asignado a</label>
                                        <input type="text" name="asig-tarea" id="asig-tarea" class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                </div>

                                <div class="flex gap-6 mb-4 justify-center">
                                    <div class="flex-1">
                                        <label for="fecha-tarea" class="block w-[200px] pb-3">Fecha</label>
                                        <input type="date" name="fecha-tarea" id="fecha-tarea" class="ml-2 rounded-lg w-[70%] border-2 border-blue">
                                    </div>
                                </div>

                                <div class="flex gap-6 mt-4 justify-end">
                                    <button type="submit" id="saveTask" class="bg-blue text-white p-3 px-6 rounded-lg">Guardar</button>
                                    <button type="button" class="bg-orange text-white p-3 px-6 rounded-lg">Eliminar</button>
                                </div>
                            </form>
                        </div>
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
                            class="bg-transparent border-none rounded-[100px] text-white font-roboto text-xs font-medium outline-none w-full"
                            onkeyup="handleSearch()"
                        />
                        <!-- Search Icon -->
                        <img class="w-[20px] h-[20px]" src="../images/svg-buscar.svg" alt="Search Icon" />
                    </div>
                </div>
            </div>

            <!-- JavaScript (for Search functionality) -->
            <script>
                function handleSearch() {
                    const searchText = document.getElementById('searchInput').value;
                    console.log('Search Term:', searchText); // Logs the search term for debugging purposes
                    // You can add additional logic here to filter or display search results on the page
                }
            </script>
            </div>



            <div class="w-full h-full flex flex-col  absolute px-4">
                <div class="absolute left-0 top-[6em] animate-left">
                    <a href="/"  class="hover:text-white hover:border-none justify-start p-2 px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6"><<< Volver al inicio</a>
                    <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6">
                        {{ __('<<< Volver al inicio') }}
                    </x-nav-link> -->
                </div>
                <div class="absolute right-0 top-[10em] animate-right">
                    <a href="tareas-historial" class="hover:text-white hover:border-none justify-end px-4 rounded-tl-[0px] rounded-tl-[50px] rounded-bl-[50px] rounded-bl-[0px] px-4 bg-blue w-[200px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 flex justify-end items-center"> Historial de tareas >>></a>
                <!-- <x-nav-link :href="route('tareas-historial')" :active="request()->routeIs('tareas-historial')" class="hover:text-white hover:border-none justify-end px-4 rounded-tl-[0px] rounded-tl-[50px] rounded-bl-[50px] rounded-bl-[0px] px-4 bg-blue w-[200px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 flex justify-end items-center">
                {{__('Historial de tareas >>>') }} </a> 
            </x-nav-link> -->
            </div>


                <div class="text-center justify-center mt-20 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Plataforma de <span class="text-two font-roboto_condensed_bold text-orange">Tareas</span>
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
    <div class="absolute inset-0 flex justify-center items-center">
        <button class="p-4 bg-blue rounded-lg text-white w-[120px]">Ver todos</button>
    </div>
</div>



    </div>

</x-app-layout>
