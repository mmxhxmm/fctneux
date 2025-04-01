<x-guest-layout>
    <div class="mb-4 text-[12px] text-white">
        <p class="flex items-center mt-2 justify-center">¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña que te permitirá elegir una nueva.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-10">
            <label for="email" :value="__('Email')" >
            <input id="email" class="block border-2 text-[12px] text-white border-white rounded-full bg-transparent w-full h-1/2 placeholder-white"
                            placeholder="Email..." 
                            type="email" 
                            name="email" :value="old('email')" 
                            required autofocus autocomplete="username" />
                            
            <error :messages="$errors->get('email')" class="mt-2" />
            </label>
        </div>

        <div class="flex items-center justify-center mt-12 space-x-6">
            <button class="w-[50%] bg-orange text-white px-4 py-2 text-[18px]">Enviar</button>
            <button class="w-[50%] bg-red-500 text-white px-4 py-2 text-[18px]">Cancelar</button>
        </div>

    </form>
</x-guest-layout>
