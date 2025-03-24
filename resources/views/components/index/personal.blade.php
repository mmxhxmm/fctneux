<div {{ $attributes->merge(['class' => 'user-card w-[342px] h-[342px] p-4 flex-grow-0 shadow-lg opacity-90 border-2 border-blue bg-white', 'data-municipio' => strtolower($user->municipio), 'tabindex' => 0]) }}>
    <p class="text-semibold m-4"><b>Nombre: </b>{{ $user->name }}</p>
    <p class="text-semibold m-4"><b>Correo: </b>{{ $user->email }}</p>
    <p class="text-semibold m-4"><b>Telefono: </b>{{ $user->telefono }}</p>
    <p class="text-semibold m-4">
        <b>Situación: </b>
        <span class="{{ $user->situacion == 'Alta' ? 'text-green-500' : ($user->situacion == 'Baja' ? 'text-red-500' : 'text-black') }}">
            {{ $user->situacion }}
        </span>
    </p>
    <p class="text-semibold m-4"><b>Municipio: </b>{{ $user->municipio }}</p>
    <p class="text-semibold m-4">
        <b>Role: </b>
        <span class="{{ $user->role == 'admin' ? 'text-orange' : ($user->role == 'coordinador' ? 'text-blue' : 'text-black') }}">
            {{ $user->role }}
        </span>
    </p>
</div>