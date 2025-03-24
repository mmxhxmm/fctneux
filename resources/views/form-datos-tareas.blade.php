<x-app-layout>
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[450px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/tareasheader.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <!-- <div class="absolute inset-0 bg-primary opacity-40"></div> -->
            
            <!-- Main Heading and Buttons -->
            <div class="bg-black_transp h-16 relative flex justify-between items-center px-10 w-full">
            <!-- Left buttons (Añadir and Eliminar) -->
            <div class="flex items-center space-x-4">
                <div class="w-[110px] h-10">
                    <!-- <div class="bg-[#ff8300] rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                        <button class="text-white font-roboto text-base font-bold">+ Añadir</button>
                    </div> -->
                </div>

                <div class="w-[110px] h-10">
                    <!-- <div class="bg-[#002f86] rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                        <button class="text-white font-roboto text-base font-bold">- Eliminar</button>
                    </div> -->
                </div>
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

                <!-- Barcelona / BCN Dropdown -->
                <select class="bg-black_transp rounded-[100px] border-2 border-white w-[200px] h-[40px] flex items-center pl-4 pr-2 text-white text-base font-medium">
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
                            class="bg-transparent border-none rounded-[100px] text-white text-xs font-medium outline-none w-full"
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
                    <a href="/" class="p-2 hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left flex-grow-0 mb-6"><<< Volver al inicio</a>
                    <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6">
                        {{ __('<<< Volver al inicio') }}
                    </x-nav-link> -->
                </div>
                <div class="absolute left-0 top-[10em] animate-left2">
                    <button class="hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-blue w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left flex-grow-0">
                       <a href="https://outlook.office.com/calendar/view/workweek" ><<< Ir al calendario</a> 
                    </button>
                </div>




                <div class="text-center justify-center mt-20 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Datos de <span class="text-two font-roboto_condensed_bold text-orange">Tareas</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex justify-center bg-white items-center">
        <div class="border-2 border-blue w-[70%] h-auto">
        <div class="bg-blue text-white text-center p-2 text-four">Datos</div>
        
        <div class="p-16 text-blue flex justify-between items-start">
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
