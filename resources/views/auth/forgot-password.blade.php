<x-guest-layout>
    <a href="{{ route('dashboard') }}" class="bg-black_transp px-4 py-1 rounded text-white">
        <- Volver
    </a>

    <div class="my-4 text-white">
        <h2 class="text-center text-2xl mb-2">¿Olvidaste tu contraseña?</h2>
        <p class="text-center text-[12px] mb-2">No hay problema.</p>
        <p class="flex items-center text-[12px] justify-center">Indica tu dirección de correo electrónico y un administrador te va a contactar para resetearla.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-8">
            <label for="email" :value="__('Email')" >
            <x-text-input id="email" class="block text-[12px] text-white border-white rounded-full bg-transparent w-full h-1/2 placeholder-white"
                placeholder="Email..." 
                type="email" 
                name="email" :value="old('email')" 
                required autofocus autocomplete="username" />
                            
            <error :messages="$errors->get('email')" class="mt-2" />
            </label>
        </div>

        <div class="flex items-center justify-center mt-10 space-x-6">
            <button class="w-[50%] bg-orange text-white px-4 py-2 text-[18px]">Enviar</button>
        </div>
    </form>
</x-guest-layout>
