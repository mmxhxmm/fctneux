<div
    data-aos="fade-up"
    data-aos-offset="150"
    data-aos-once="true"
    {{ $attributes->merge([
        'class' => 'user-card w-full max-w-md rounded-2xl bg-white border m-1 border-blue  shadow-md hover:shadow-blue/30 transition-all duration-300',
        'data-municipio' => strtolower($user->municipio),
        'tabindex' => 0
    ]) }}>
    

    <div class="bg-white_dull px-4 py-4 mb-1 flex items-center justify-between"
        style="border-top-left-radius: 1.05rem; border-top-right-radius: 1.05rem;">
            <h2 class="text-xl font-semibold text-blue">{{ $user->name }}</h2>
            <span class="px-3 py-1 text-sm rounded-full font-medium
                {{ 
                    $user->situacion === 'alta' ? 'bg-green-100 text-green-700' :
                    ($user->situacion === 'baja' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') 
                }}">
                {{ ucfirst($user->situacion) }}
            </span>
        </div>

        <!-- Details -->
        <div class="space-y-4 text-[16px] p-6  text-gray-800 font-roboto leading-relaxed">
            <div class="space-y-2">
            <div class="flex justify-between items-center pb-2">
                <span class="text-sm text-gray-500 font-medium">Email</span>
                <span class="text-base text-gray-900 font-medium">{{ $user->email }}</span>
            </div>
            <div class="flex justify-between items-center  pb-2">
                <span class="text-sm text-gray-500 font-medium">Teléfono</span>
                <span class="text-base text-gray-900 font-medium">{{ $user->telefono }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500 font-medium">Municipio</span>
                <span class="text-base text-gray-900 font-medium">{{ ucfirst($user->municipio) }}</span>
            </div>
        </div>

        <div>
            <p class="text-xs text-blue uppercase font-semibold tracking-wide mb-1">Rol</p>
            <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full font-medium bg-gray-200 text-gray-800">
                {{ ucfirst($user->role) }}
            </span>
        </div>
    </div>
</div>
