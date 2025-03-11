<<Welcome to the Cheatsheet>>
(We will delete this later, don't you worry Maham)

HACER ANTES QUE COMITEAR A DEV:
git fetch origin -> Update branches
git merge dev -> Merge dev a tu branch
git checkout dev -> Ir a dev + no olvidar Actualizarlo!
git merge [your_branch] -> Mergear tu branch a dev y resolver conflictos

[ADMIN ROLE INSIDE BLADE]
@if (Auth::user()->role == 'admin')
OR
{{ __("You are a :role", ['role' => Auth::user()->role]) }}