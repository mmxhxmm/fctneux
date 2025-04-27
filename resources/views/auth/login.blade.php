<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-6">
            <label for="email" :value="__('Email')" >
            <x-text-input id="email" class="block text-[12px] text-white border-white rounded-full bg-transparent w-full h-1/2 placeholder-white"
                placeholder="Email..." 
                type="email" 
                name="email" :value="old('email')" 
                required autofocus autocomplete="username" />
                            
            <error :messages="$errors->get('email')" class="mt-2" />
            </label>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" :value="__('Password')" >

            <x-text-input id="password" class="block text-[12px] text-white border-white rounded-full bg-transparent w-full h-1/2 placeholder-white"
                placeholder="Contraseña..."
                type="password"
                name="password"
                required autocomplete="current-password" />

            <error :messages="$errors->get('password')" class="mt-2" />
            </label>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300  text-indigo-600 shadow-sm focus:ring-indigo-500 " name="remember">
                <span class="ms-2 text-[12px] text-white">Remember me</span>
            </label>
        </div>

        <div class="flex items-center flex justify-center mt-4">
            @if (Route::has('password.request'))
            <a class="underline hover:no-underline text-[12px] mt-2 mb-2 text-sm text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('password.request') }}">
                Solicitar restablecer la contraseña
            </a>
            @endif
        </div>
        
        <div class="flex items-center justify-center mt-2">
            <button class="w-[330px] mt-2 bg-orange text-white p-2 mb-2 ms-3 text-[18px]">
                Enter
            </button>
        </div>
    </form>
</x-guest-layout>
