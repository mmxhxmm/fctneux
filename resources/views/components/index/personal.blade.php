<div
    data-aos="fade-up"
    data-aos-offset="150"
    data-aos-once="true"
    {{ $attributes->merge([
        'class' => 'user-card flex flex-col justify-between w-[350px] rounded-2xl bg-white border m-1 border-blue shadow-md hover:shadow-blue/30 transition-all duration-300',
        'data-municipio' => strtolower($user->municipio),
        'tabindex' => 0
    ]) }}>
    

    <div>
        <div class="bg-white_dull px-4 py-4 mb-1 flex items-center justify-between"
        style="border-top-left-radius: 1.05rem; border-top-right-radius: 1.05rem;">
            <h2 class="text-xl font-semibold text-blue">{{ $user->name }}</h2>
            <span class="user-role px-3 py-1 text-sm rounded-full font-medium text-white
            {{ $user->role == 'admin' ? 'bg-orange' : ($user->role == 'coordinador' ? 'bg-blue' : 'bg-gray-400') }}">
                {{ ucfirst($user->role) }}
            </span>
        </div>

        <!-- Details -->
        <div class="space-y-4 text-[16px] p-6 text-gray-800 font-roboto leading-relaxed">
            <div class="space-y-2">
                <div class="flex justify-between items-center pb-2">
                    <span class="text-sm text-gray-500 font-medium">Email</span>
                    <span class="text-base text-gray-900 font-medium">{{ $user->email }}</span>
                </div>
                @if (isset($user->telefono))
                <div class="flex justify-between items-center  pb-2">
                    <span class="text-sm text-gray-500 font-medium">Teléfono</span>
                    <span class="text-base text-gray-900 font-medium">{{ $user->telefono }}</span>
                </div>
                @endif
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500 font-medium">Municipio</span>
                    <span class="text-base text-gray-900 font-medium">{{ ucfirst($user->municipio) }}</span>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'coordinador')
    <div class="pb-3 px-5 flex justify-end">
        <button 
            id="edit-btn-{{ $user->id }}"
            type="button"
            class="edit-btn px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            > Editar
        </button>
    </div>
    @endif
</div>
