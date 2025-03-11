<<Welcome to the Cheatsheet>>
(We will delete this later, don't you worry Maham)

git fetch origin -> Update branches, hacer antes que comitear


[ADMIN ROLE INSIDE BLADE]
@if (Auth::user()->role == 'admin')
OR
{{ __("You are a :role", ['role' => Auth::user()->role]) }}