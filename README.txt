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

[API -> GeoAPI España]
// https://apiv1.geoapi.es/docs/api/metodos.html
// https://geoapi.es/pruebalo
 
// All Comunidades
$response = file_get_contents("https://apiv1.geoapi.es/comunidades?type=JSON&key=bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06");
$provincias = json_decode($response);
foreach ($provincias->data as $p) {
    \Log::info("API Response: " . $p->CCOM);
}
 
// Comunidad -> Cataluña
$response = file_get_contents("https://apiv1.geoapi.es/provincias?CCOM=09&type=JSON&key=bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06");
$provincias = json_decode($response);
var_dump($provincias->data);
foreach ($provincias->data as $p) {
    \Log::info("API Response: " . $p->PRO);
}
 
// Provincia -> Barcelona
$response = file_get_contents("https://apiv1.geoapi.es/municipios?CPRO=08&type=JSON&key=bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06");
$provincias = json_decode($response);
$array = $provincias->data;
\Log::info(gettype($array));
var_dump($array);
foreach ($array as $p) {
    \Log::info("API Response: " . $p->DMUN50);
}

// Add to visulaize data (to lowercase and first letter uppercase) ->
ucwords(mb_strtolower())

// Parse date
\Carbon\Carbon::parse($date)->format('d-m-Y');