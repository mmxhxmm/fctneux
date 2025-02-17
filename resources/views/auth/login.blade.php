<x-guest-layout class="font-roboto">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-6">
            <label for="email" :value="__('Email')" >
            <input id="email" class="block border-2 text-[12px] text-white border-white rounded-full bg-transparent w-full h-1/2 placeholder-white"
                            placeholder="Email..." 
                            type="email" 
                            name="email" :value="old('email')" 
                            required autofocus autocomplete="username" />
                            
            <error :messages="$errors->get('email')" class="mt-2" />
            </label>
        </div>

        <!-- Password -->
        <div class="mt-2">
            <label for="password" :value="__('Password')" >

            <input id="password" class="block border-2 text-[12px] text-white border-white rounded-full bg-transparent w-full h-1/2 placeholder-white"
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
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-center mt-2">
            @if (Route::has('password.request'))
                <a class="text-[12px] mt-2 mb-2 text-sm text-white hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    Solicitar restablecer la contraseña
                </a>
            @endif
        </div>
        
        <div class="flex items-center justify-center mt-2 bg-[#FF8300] text-white p-2 mb-2">
            <button class="ms-3 text-[18px]">Enter</button>
        </div>
        
    </form>
</x-guest-layout>
