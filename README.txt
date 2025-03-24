<<Welcome to the Cheatsheet>>
(We will delete this later, don't you worry Maham)

[HACER ANTES QUE COMITEAR A DEV]
git fetch origin -> Update branches
git merge dev -> Merge dev a tu branch
git checkout dev -> Ir a dev + no olvidar Actualizarlo!
git merge [your_branch] -> Mergear tu branch a dev y resolver conflictos

[ADMIN ROLE INSIDE BLADE]
@if (Auth::user()->role == 'Admin')
OR
{{ __("You are a :role", ['role' => Auth::user()->role]) }}

[Example on how to add an Accesor in the Model]
(-> Replace Image with the variable you want to change)
(-> Use this to change the value of the variable to mayuscula for example)
public function getImageAttribute($value) {
    return '/storage/' . $value;
}

[Guardar data en laravel.log]
\Log::info();

[Utilizar en blade para rutas]
{{ route('') }} <- Poner el name('') del web aqui, utilizar para que no se lia con las subcarpetas