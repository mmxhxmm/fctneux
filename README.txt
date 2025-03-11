<<Welcome to the Cheatsheet>>
(We will delete this later, don't you worry Maham)

HACER ANTES QUE COMITEAR A DEV:
git fetch origin -> Update branches
git merge dev -> Merge dev a tu branch


[ADMIN ROLE INSIDE BLADE]
@if (Auth::user()->role == 'admin')
OR
{{ __("You are a :role", ['role' => Auth::user()->role]) }}