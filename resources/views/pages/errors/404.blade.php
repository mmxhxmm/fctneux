<x-app-layout>
    <section class="bg-white">
        <div class="h-[75vh] flex flex-col items-center justify-center gap-10 p-10">
            <img src="../images/errorOscuro.png" alt="" class="w-[50%]">
            <button onclick="{{ route('dashboard') }}" class="bg-[#263652] mb-6 text-white font-bold py-2 px-10 shadow-xl hover:size-30 transition duration-200 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                Regresar
            </button>
        </div>
    </section>
</x-app-layout>