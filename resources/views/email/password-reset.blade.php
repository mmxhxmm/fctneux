@component('mail::message')
# Password Reset Request

Este usuario ha solicitado resetear el password:

Nombre: <b>{{ $user->name }}</b>

Email: <b>{{ $user->email }}</b>

Situación: <b>{{ $user->situacion }}</b>

Municipio: <b>{{ $user->municipio }}</b>

<br>
Si piensas que fuera un error, ignora este email.

<br><br>
Gracias,<br>
{{ config('app.name') }}

@endcomponent
