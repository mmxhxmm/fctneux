<x-app-layout>
<div class="relative h-[300px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/form-empresa.png'); background-size: cover; background-position: center;">
            <div class="w-full h-full flex flex-col  absolute px-4 ">
            <x-button-salir :redirect="route('empresa-index')" />
                <div class="text-center justify-center mt-20 fade-in">
                    <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                        Añadir nueva <span class="text-two font-roboto_condensed_bold text-orange">Empresa</span>
                    </p>
                </div>
            </div>
        </div>


    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow sm:rounded-lg ">
                <div class="w-full flex justify-center">
                    <div class="w-[50em]">
                        @include("pages.partials.{$form}")
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relative h-[250px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/bg-details-btm.png'); background-size: cover; background-position: center;">

</x-app-layout>