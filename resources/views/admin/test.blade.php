<x-app-layout>
    <div style="w-full background-color:gray; display:flex; justify-content: center; align-items: center; margin: 0;">
        <div style="background-color:white; width:60em; margin:5em 0">
            <div style="margin: 2em 5em">
                <div style="padding:1em 5em">
                    <h1 class="text-xl font-bold mb-2">Users</h1>
                    @if(count($users) > 0)
                        @foreach ($users as $key => $user)
                            <p>Name: {{ $user->name }}</p>
                            <p>Email: {{ $user->email }}</p>
                            <p>Role: {{ $user->role }}</p>
                            <p>Password: {{ $user->password }}</p>
                            <p>----------------------------------------------</p>
                        @endforeach
                    @else
                        <p>No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>