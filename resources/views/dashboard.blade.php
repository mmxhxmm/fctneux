<x-app-layout>
    <div class="w-full h-screen flex flex-col">
        <!-- Background Image Section -->
        <div class="relative flex-grow-0 flex-shrink-0" style="background-image: url('../images/Fct-bg.png'); background-size: cover; background-position: center; height: 50vh;">
            <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Opacity overlay -->
            
            <!-- Main Heading -->
            <div class="w-full h-full flex flex-col items-center justify-center relative px-4">
                <div class="text-center">
                    <p class="text-[70px] font-extrabold text-white leading-tight tracking-tight">
                        {{ __("FCT") }}<span class="text-[#FF8300]">Nexus</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="w-full flex-grow flex items-center justify-center mt-4 " style="height: 50vh;">
            <!-- First Button -->
            <div class="relative w-full">
                <button class="w-full text-white text-bold py-12 text-xl font-bold shadow-lg clip-diagonal hover:opacity-90 " style="background-image: url('../images/empresa-bg.png'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 bg-[#002F86] opacity-70 "></div>
                    <p class="relative mt-4 text-center font-extrabold text-[18px]">Acceso a Plataforma de</p>
                    <p class="relative mt-2 text-center text-lg font-extrabold">EMPRESAS</p>
                    <div class="flex justify-center items-center mt-6 relative z-10">
                        <div class="w-12 h-12 rounded-full bg-[#FF8300] flex items-center justify-center">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <line style="fill:none;stroke:#ffffff;stroke-width:2;stroke-miterlimit:10;" x1="6" y1="16" x2="28" y2="16"></line> <polyline style="fill:none;stroke:#ffffff;stroke-width:2;stroke-miterlimit:10;" points="11.515,22 5.515,16 11.515,10 "></polyline> </g></svg>
                        </div>
                    </div>
                </button>
            </div>

            <!-- Second Button -->
            <div class="relative w-full mt-4">
                <button class="w-full text-white text-bold py-12 text-xl font-bold shadow-lg clip-diagonal-reverse hover:opacity-90 " style="background-image: url('../images/tareas-bg.png'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 bg-[#FF8300] opacity-70"></div>
                    <p class="relative mt-4 text-center font-extrabold text-[18px]">Acceso a Registro de</p>
                    <p class="relative mt-2 text-center text-lg font-extrabold">TAREAS</p>
                    <div class="flex justify-center items-center mt-6 relative z-10">
                        <div class="w-12 h-12 rounded-full bg-[#002F86] flex items-center justify-center">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <line style="fill:none;stroke:#ffffff;stroke-width:2;stroke-miterlimit:10;" x1="26" y1="16" x2="4" y2="16"></line> <polyline style="fill:none;stroke:#ffffff;stroke-width:2;stroke-miterlimit:10;" points="20.485,10 26.485,16 20.485,22 "></polyline> </g></svg>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <style>
        .clip-diagonal {
            clip-path: polygon(0% 0%, 100% 0%, 90% 100%, 0% 100%);
        }
        .clip-diagonal-reverse {
            clip-path: polygon(10% 0%, 100% 0%, 100% 100%, 0% 100%);
        }
    </style>
</x-app-layout>
