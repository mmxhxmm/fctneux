<x-app-layout>
    <div class="w-full flex flex-col grid-rows-3 bg-white">
        <!-- Background Image Section -->
        <div class="relative h-80 flex-grow-0 flex-shrink-0" style="background-image: url('../images/fct-bg.png'); background-size: cover; background-position: center;">
            <!-- Opacity overlay -->
            <div class="absolute inset-0 bg-primary opacity-40"></div>
            
            <!-- Main Heading -->
            <div class="w-full h-full flex flex-col items-center justify-center relative px-4 fade-in">
                <div class="text-center">
                    <p class="text-one font-hammersmith text-white" style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        FCT<span class="text-orange">Nexus</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="w-full relative mt-12 mb-14 sm:h-[20.2em] flex flex-col sm:flex-row items-start justify-center">
            <!-- First Button (Acceso a Plataforma) -->
            <div class="relative w-full h-[15em] sm:h-full animate-left">
                <a href="{{ route('empresa-index') }}">
                    <button class="w-full h-full shadow-lg clip-diagonal hover:opacity-90 " style="background-image: url('../images/empresa-bg.png'); background-size: cover; background-position: center;">
                        <div class="text-white mr-6 text-bold h-[12em]">    
                            <div class="absolute inset-0 bg-blue opacity-70"></div>
                            <p class="text-xl relative text-center font-roboto_condensed_bold">Acceso a Plataforma<br>de</p>
                            <p class="mt-4 text-2xl font-extrabold relative text-center">EMPRESAS</p>
                        </div>
                        <!-- Arrow cont -->
                        <div class="absolute pr-6 top-[11.5em] sm:top-[15.5em] left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div class="w-[4.5rem] h-[4.5rem] rounded-full bg-orange flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="-1 0 25 24" class="fill-white_dull scale-x-[-1]">
                                <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                            </svg>
                        </div>
                    </button>
                </a>
            </div>

            <!-- Second Button (Acceso al Registro) -->
            <div class="relative w-full h-[15em] sm:h-full animate-right">
                <a href="{{ route('tareas-index') }}">
                    <button class="w-full h-full shadow-lg clip-diagonal-reverse hover:opacity-90" style="background-image: url('../images/tareashead.png'); background-size: cover; background-position: center;">
                    <div class="text-white ml-6 text-bold h-[12em]">
                            <div class="absolute inset-0 bg-orange opacity-70"></div>
                            <p class="text-xl relative text-center font-roboto_condensed_bold">Acceso al Registro<br>de</p>
                            <p class="mt-4 text-2xl font-extrabold relative text-center">TAREAS</p>
                    </div>
                    <!-- Arrow cont -->
                        <div class="absolute ml-3 top-[11.5em] sm:top-[15.5em] left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <div class="w-[4.5rem] h-[4.5rem] rounded-full bg-blue flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="-1 0 25 24" class="fill-white_dull">
                                <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                            </svg>
                        </div>
                    </button>
                </a>
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

        /* Fade-in animation for FCT Nexus */
        .fade-in {
            animation: fadeIn 2s ease-in;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        /* Slide-in from left for the 'Acceso a Plataforma' div */
        .animate-left {
            opacity: 0;
            transform: translateX(-100%);
            animation: slideInLeft 2s forwards;
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

        /* Slide-in from right for the 'Acceso al Registro' div */
        .animate-right {
            opacity: 0;
            transform: translateX(100%);
            animation: slideInRight 2s forwards;
        }

        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* More inclined */
        /* .clip-diagonal {
            clip-path: polygon(0% 0%, 100% 0%, 80% 100%, 0% 100%);
        }

        .clip-diagonal-reverse {
            clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);
        } */
    </style>
</x-app-layout>
