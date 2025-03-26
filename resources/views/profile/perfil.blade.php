<x-app-layout>
<section class="bg-white overflow-hidden">
    <section style="background-image: url('../images/Group 58.png');" class="relative flex-grow-0 flex-shrink-0 bg-fixed bg-cover bg-center mb-16">

        <!-- <section class="relative pt-6">
            <div class="bg-white shadow-xl w-[300px] h-[300px] absolute left-[4%] rounded-full">
            
            </div>
        </section> -->
        @if(count($users) > 0)
        @foreach ($users as $key => $user)
        @if (Auth::user()->id == $user->id)
        <section class="absolute md:left-[24%] md:top-[180px]">
            <div class="bg-[#ff8300] rounded-[5px] shadow-xl px-10 py-2">
                <div class="text-white text-center font-['Roboto-Bold',_sans-serif] text-[20px] font-bold">{{ $user->name }}<!-- Aqui el nombre del usuario --></div>
            </div>
        </section>

        <section class="pt-[7%]">
            <section class="md:mx-[9%] sm:mx-[3%] p-6">
                <div class="flex flex-col md:flex-row md:gap-24 w-full">

                <div class="bg-[#002f86] text-white p-8 sm:w-[60%] md:w-[50%] h-[360px]">
                    <div class="flex-col items-start">
                        <h2 class="text-2xl font-bold mt-7 mb-7">USUARIO:</h2>
                        <div class="mt-4 flex w-full">
                            <p><b>Nivel de acceso: </b><span style="margin-left: auto; margin-right: 0;">{{ $user->role }}</span></p>
                        </div>
                        <div class="mt-4 flex w-full">
                            <p><b>Provincia: </b><span style="margin-left: auto; margin-right: 0;">{{ $user->municipio }}</span></p>
                        </div>
                        <div class="mt-4 flex w-full">
                            <p><b>Telefono: </b><span style="margin-left: auto; margin-right: 0;">{{ $user->telefono }}</span></p>
                        </div>
                        <div class="mt-4 flex w-full">
                            <p><b>Correo: </b><span style="margin-left: auto; margin-right: 0;">{{ $user->email }}</span></p>
                        </div>
                        <div class="mt-4 flex w-full">
                            <p><b>Situación: </b><span style="margin-left: auto; margin-right: 0;">{{ $user->situacion }}</span></p>
                        </div>
                    </div>
                </div>


                    @endif
                    @endforeach
                    @else
                        <p>No users found.</p>
                    @endif 
                    <input type="checkbox" id="toggle" class="hidden peer"/>

                    <!-- const dropdownBtn = document.getElementById("btn");
const dropdownMenu = document.getElementById("dropdown");
const toggleArrow = document.getElementById("arrow");

// Toggle dropdown function
const toggleDropdown = function () {
  dropdownMenu.classList.toggle("show");
  toggleArrow.classList.toggle("arrow");
};

// Toggle dropdown open/close when dropdown button is clicked
dropdownBtn.addEventListener("click", function (e) {
  e.stopPropagation();
  toggleDropdown();
});

// Close dropdown when dom element is clicked
document.documentElement.addEventListener("click", function () {
  if (dropdownMenu.classList.contains("show")) {
    toggleDropdown();
  }
}); -->

                    <div class="w-full h-[400px] bg-white border-[10px] border-[#002f86] p-6 rounded-[30px] mt-[-75px] peer-checked:h-[500px] transition-all duration-500">
                        <h3 class="text-xl text-[#002f86] text-center font-extrabold">TAREAS PENDIENTES</h3>
                        <ul class="mt-10 space-y-4">
                            <li class="flex items-center text-[#ff8300] font-bold">
                                <div class="w-8 h-8 flex items-center justify-center bg-[#ff8300] text-white rounded-full text-xl">!</div>
                                <span class="ml-3"> <!--Aqui la tarea--> </span>
                            </li>
                            <li class="flex items-center text-[#ff8300] font-bold">
                                <div class="w-8 h-8 flex items-center justify-center bg-[#ff8300] text-white rounded-full text-xl">!</div>
                                <span class="ml-3"> <!--Aqui la tarea--> </span>
                            </li>
                            <li class="flex items-center text-[#ff8300] font-bold">
                                <div class="w-8 h-8 flex items-center justify-center bg-[#ff8300] text-white rounded-full text-xl">!</div>
                                <span class="ml-3"> <!--Aqui la tarea--> </span>
                            </li>
                            <li class="flex items-center text-[#ff8300] font-bold">
                                <div class="w-8 h-8 flex items-center justify-center bg-[#ff8300] text-white rounded-full text-xl">!</div>
                                <span class="ml-3"> <!--Aqui la tarea--> </span>
                            </li>
                            <li class="flex items-center text-[#ff8300] font-bold hidden peer-checked:block">
                                <div class="w-8 h-8 flex items-center justify-center bg-[#ff8300] text-white rounded-full text-xl">!</div>
                                <span class="ml-3"> <!--Aqui la tarea--> </span>
                            </li>
                            <li class="flex items-center text-[#ff8300] font-bold hidden peer-checked:block">
                                <div class="w-8 h-8 flex items-center justify-center bg-[#ff8300] text-white rounded-full text-xl">!</div>
                                <span class="ml-3"> <!--Aqui la tarea--> </span>
                            </li>
                        </ul>
                        <div class="flex justify-center mt-[8%] mb-[-10px]">
                            <button class="bg-[#ff8300] text-white px-3 py-3 rounded-full text-bold">

                            <label for="toggle" class="cursor-pointer transition-all duration-500 ease-in-out">
                                <img class="w-[20px] peer-checked:hidden" src="../images/flecha-hacia-abajo.png" alt="">
                            </label>
                            <label for="toggle" class="cursor-pointer transition-all duration-500 ease-in-out">
                                <img class="w-[20px] hidden peer-checked:block" src="../images/flecha-hacia-arriba.png" alt="">
                            </label>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</section>
</x-app-layout>