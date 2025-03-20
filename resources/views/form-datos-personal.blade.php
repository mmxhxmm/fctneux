<x-app-layout>
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- First Container with Background Image -->
        <div class="relative h-[450px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/personalactivo.png'); background-size: cover; background-position: center;">
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
                        <div class="text-white font-roboto text-base font-medium ml-2">
                            Filter
                        </div>
                    </div>
                </div>

                <!-- Barcelona / BCN Dropdown -->
                <!-- <select class="bg-black_transp rounded-[100px] border-2 border-white w-[200px] h-[40px] flex items-center pl-4 pr-2 text-white font-roboto text-base font-medium">
                    <option value="barcelona">Barcelona / BCN</option>
                    <option value="madrid">Madrid / Mad</option>
                    <option value="valencia">Valencia / Val</option>
                </select> -->

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
                <a href="/" class="p-2 hover:text-white hover:border-none justify-start px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[170px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 mb-6"><<< Volver al inicio</a>
                </div>
                <!-- <div class="absolute right-0 top-[10em]">
                <x-nav-link :href="route('personal-suspendidos')" :active="request()->routeIs('personal-suspendidos')" class="justify-end px-4 rounded-tl-[0px] rounded-tl-[50px] rounded-bl-[50px] rounded-bl-[0px] px-4 bg-blue w-[200px] h-[40px] opacity-90 text-[16px] text-white text-left font-roboto flex-grow-0 flex justify-end items-center">
                {{__('Usuarios suspendidos >>>') }} </a> 
            </x-nav-link>
            </div> -->




                <div class="text-center justify-center mt-24 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Datos de <span class="text-three font-roboto_condensed_bold text-orange">Personas</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex justify-center bg-white items-center">
            <div class = "border-2 border-blue w-[70%] h-auto ">
                <div class= "bg-blue text-white text-center p-2 text-four">Datos</div>
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

        </div>
    </div>





<div class="relative h-[420px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/bottomtareas.png'); background-size: cover; background-position: center;">
</div>



    </div>
</x-app-layout>
