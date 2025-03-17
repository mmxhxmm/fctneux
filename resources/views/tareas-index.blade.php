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
                <!-- Añadir button -->
                <div class="w-[110px] h-10">

                    <div class="bg-[#ff8300] rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                        <a href="datos-tareas" class="hover:text-white no-underline text-white font-roboto text-base font-bold">+ Añadir</a>
                    </div>
                </div>

                <!-- Eliminar button -->
                <div class="w-[110px] h-10">
                    <div class="bg-[#002f86] rounded-[100px] w-[110px] h-10 flex justify-center items-center">
                        <button class="text-white font-roboto text-base font-bold">- Eliminar</button>
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
