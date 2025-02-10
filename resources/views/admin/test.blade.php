<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }}</title>
    </head>
    <body style="background-color:gray; display:flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
        <div style="background-color:white; width:60em; margin:10em 0">
            <div style="margin: 2em 5em">
                <div style="padding:1em 5em">
                    <h1>Users</h1>
                    @if(count($users) > 0)
                        @foreach ($users as $key => $user)
                            <p>Name: {{ $user->name }}</p>
                            <p>Email: {{ $user->email }}</p>
                            <p>Password: {{ $user->password }}</p>
                            <p>----------------------------------------------</p>
                        @endforeach
                    @else
                        <p>No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>