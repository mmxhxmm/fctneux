<div 
    {{ $attributes->merge([
        'class' => 
            'user-card w-[342px] h-[360px] rounded-xl p-6 bg-white shadow-xl border border-blue hover:shadow-2xl transition-all duration-300',
        'data-municipio' => strtolower($user->municipio),
        'tabindex' => 0
    ]) }}
>
    <div class="space-y-4 text-[17px] text-gray-800 font-roboto">
        <p>
            <span class="font-semibold text-blue">Nombre:</span> {{ $user->name }}
        </p>
        <p>
            <span class="font-semibold text-blue">Correo:</span> {{ $user->email }}
        </p>
        <p>
            <span class="font-semibold text-blue">Teléfono:</span> {{ $user->telefono }}
        </p>
        <p>
            <span class="font-semibold text-blue">Situación:</span>
            <span class="{{ 
                $user->situacion === 'Alta' ? 'text-green-600 font-medium' : 
                ($user->situacion === 'Baja' ? 'text-red-600 font-medium' : 'text-gray-600') 
            }}">
                {{ $user->situacion }}
            </span>
        </p>
        <p>
            <span class="font-semibold text-blue">Municipio:</span> {{ $user->municipio }}
        </p>
        <p>
            <span class="font-semibold text-blue">Rol:</span>
            <span class="{{ 
                $user->role === 'admin' ? 'text-orange font-semibold' : 
                ($user->role === 'coordinador' ? 'text-blue font-semibold' : 'text-gray-700 font-medium') 
            }}">
                {{ ucfirst($user->role) }}
            </span>
        </p>
    </div>
</div>
