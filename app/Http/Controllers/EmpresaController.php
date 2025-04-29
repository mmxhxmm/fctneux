<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\ResponsableConvenio;
use App\Models\CentroTrabajo;
use App\Models\PersonaContacto;
use App\Models\Practica;
use App\Models\Tutor;
use App\Models\TutorEmpresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    // Function index
    public function index(Request $request)
    {
        $empresas = Empresa::all()->reverse();
    
        // Get all distinct modalidades
        $modalidadesRaw = Empresa::select('modalidad')->distinct()->pluck('modalidad')->toArray();
        $modalidades = collect($modalidadesRaw)->mapWithKeys(function ($item) {
            $formatted = match ($item) {
                'presencial' => 'Presencial',
                'remoto' => 'Remoto',
                'semipresencial' => 'Semipresencial',
                default => ucfirst($item)
            };
            return [$item => $formatted];
        });
    
        // Get all distinct colaboraciones
        $colaboracionRaw = Empresa::select('colaboracion')->distinct()->pluck('colaboracion')->toArray();
        $colaboraciones = collect($colaboracionRaw)->mapWithKeys(function ($item) {
            $formatted = match ($item) {
                'prospeccion' => 'Prospección',
                'colaboracion' => 'Colaboración',
                'inactiva' => 'Inactiva',
                default => ucfirst($item)
            };
            return [$item => $formatted];
        });
    
        $ciclosRaw = Practica::select('cicloFormativo')->distinct()->pluck('cicloFormativo')->toArray();

        $ciclos = collect($ciclosRaw)->mapWithKeys(function ($item) {
            return [$item => $item];
        });
        $provincias_raw = Empresa::select('provincia')->distinct()->pluck('provincia')->filter();
        $provincia = $provincias_raw->mapWithKeys(function ($id) {
            return [$id => $this->provinciaToString($id)];
        });


        $plazasRaw = Practica::select('numPlazasAsignadas')->distinct()->pluck('numPlazasAsignadas')->sort()->toArray();
        $plazas = collect($plazasRaw)->mapWithKeys(fn($item) => [$item => $item]);
        $familiaRaw = Empresa::select('familiaPersonal')->distinct()->pluck('familiaPersonal')->toArray();

        $familias = collect($familiaRaw)->mapWithKeys(function ($item) {
            $formatted = match ($item) {
                'sanidad' => 'Sanidad',
                'informatica' => 'Informática',
                'hosteleria' => 'Hostelería',
                'marketing' => 'Marketing',
                default => ucfirst($item)
            };
            return [$item => $formatted];
        });


        return view('pages/empresa/empresa-index', compact('empresas', 'modalidades', 'colaboraciones', 'ciclos', 'plazas','familias','provincia'));
    }

    public function filtro(Request $request)
    {
        $query = Empresa::with('practica');

        // 🔍 Search text
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                ->orWhere('colaboracion', 'like', "%$search%")
                ->orWhere('modalidad', 'like', "%$search%")
                ->orWhere('ofertaLaboral', 'like', "%$search%")
                ->orWhere('municipio', 'like', "%$search%")
                ->orWhere('familiaPersonal', 'like', "%$search%")
                ->orWhereHas('practica', fn($sub) => $sub->where('cicloFormativo', 'like', "%$search%"));
            });
        }

        if ($request->filled('modalidad')) {
            $query->where('modalidad', $request->modalidad);
        }

        if ($request->filled('colaboracion')) {
            $query->where('colaboracion', $request->colaboracion);
        }

        if ($request->filled('familia')) {
            $query->where('familiaPersonal', $request->familia);
        }

        if ($request->filled('provincia')) {
            $query->where('provincia', $request->provincia);
        }

        if ($request->filled('ciclo')) {
            $query->whereHas('practica', fn($q) => $q->where('cicloFormativo', $request->ciclo));
        }

        if ($request->filled('plazas')) {
            $query->whereHas('practica', fn($q) => $q->where('numPlazasAsignadas', $request->plazas));
        }

        $empresas = $query->get();

        $modalidades = Empresa::select('modalidad')->distinct()->pluck('modalidad')->filter()->mapWithKeys(fn($i) => [$i => ucfirst($i)]);
        $colaboraciones = Empresa::select('colaboracion')->distinct()->pluck('colaboracion')->filter()->mapWithKeys(fn($i) => [$i => match ($i) {
            'prospeccion' => 'Prospección',
            'colaboracion' => 'Colaboración',
            'inactiva' => 'Inactiva',
            default => ucfirst($i),
        }]);
        $familias = Empresa::select('familiaPersonal')->distinct()->pluck('familiaPersonal')->filter()->mapWithKeys(fn($i) => [$i => match (strtolower($i)) {
            'sanidad' => 'Sanidad',
            'informatica' => 'Informática',
            'hosteleria' => 'Hostelería',
            'marketing' => 'Marketing',
            default => ucfirst($i),
        }]);
        $provincias_raw = Empresa::select('provincia')->distinct()->pluck('provincia')->filter();
        $provincia = $provincias_raw->mapWithKeys(function ($id) {
            return [$id => $this->provinciaToString($id)];
        });

        $ciclos = Practica::select('cicloFormativo')->distinct()->pluck('cicloFormativo')->filter()->mapWithKeys(fn($i) => [$i => $i]);
        $plazas = Practica::select('numPlazasAsignadas')->distinct()->pluck('numPlazasAsignadas')->sort()->mapWithKeys(fn($i) => [$i => $i]);

        return view('pages/empresa/empresa-index', compact(
            'empresas',
            'modalidades',
            'colaboraciones',
            'familias',
            'provincia',
            'ciclos',
            'plazas'
        ));
    }

    public function provinciaToString($value) {
        $key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
        $url = "https://apiv1.geoapi.es/provincias?type=JSON&key=$key&sandbox=0";
    
        $response = @file_get_contents($url);
        if ($response === false) return $value;
    
        $data = json_decode($response, true);
        if (!isset($data['data'])) return $value;
    
        foreach ($data['data'] as $provincia) {
            if ($provincia['CPRO'] == $value) {
                return ucwords(mb_strtolower($provincia['PRO']));
            }
        }
    
        return $value;
    }
    


    // function to connect id of empresas to show specific empresa's detail
    public function index_2(Request $request)
    {
        // Get the 'id' from the query parameter
        $id = $request->query('id');

        // Fetch all empresas
        $empresas = Empresa::all();

        $usuarios = User::all();

        // Pass the empresas and the id to the view
        return view('pages/empresa/empresa-detail-view', [
            'page' => 'detail/detail-main',
        ],  compact('empresas' , 'id', 'usuarios') );
    }

    // search purpose 
    public function index_3(Request $request)
    {
        $query = $request->input('search');

        $empresas = Empresa::query()
            ->when($query, function ($q) use ($query) {
                $q->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('cif', 'like', '%' . $query . '%')
                ->orWhere('colaboracion', 'like', '%' . $query . '%')
                ->orWhere('gestiones', 'like', '%' . $query . '%')
                ->orWhere('modalidad', 'like', '%' . $query . '%')
                ->orWhere('ofertaLaboral', 'like', '%' . $query . '%')
                ->orWhere('municipio', 'like', '%' . $query . '%')
                ->orWhere('familiaPersonal', 'like', '%' . $query . '%')
                ->orWhere('provincia', 'like', '%' . $query . '%')
                ->orWhereHas('practica', function ($subQuery) use ($query) {
                    $subQuery->where('cicloFormativo', 'like', '%' . $query . '%');
                    $subQuery->where('numPlazasAsignadas', 'like', '%' . $query . '%');
                });
            })
            ->get();
                // Familia Personal
                $familiaRaw = Empresa::select('familiaPersonal')->distinct()->pluck('familiaPersonal')->toArray();

                $familias = collect($familiaRaw)->mapWithKeys(function ($item) {
                    $formatted = match (strtolower($item)) {
                        'sanidad' => 'Sanidad',
                        'informatica' => 'Informática',
                        'hosteleria' => 'Hostelería',
                        'marketing' => 'Marketing',
                        default => ucfirst($item)
                    };
                    return [$formatted => $formatted]; 
                });
        
                $colaboracionRaw = Empresa::select('colaboracion')->distinct()->pluck('colaboracion')->toArray();   
        
                $colaboraciones = collect($colaboracionRaw)->mapWithKeys(function ($item) {
                    $formatted = match ($item) {
                        'prospeccion' => 'Prospección',
                        'colaboracion' => 'Colaboración',
                        'inactiva' => 'Inactiva',
                        default => ucfirst($item)
                    };
                    return [$item => $formatted];
                });
        
                // Also grab modalidades for consistency
                $modalidadesRaw = Empresa::select('modalidad')->distinct()->pluck('modalidad')->toArray();
                $modalidades = collect($modalidadesRaw)->mapWithKeys(function ($item) {
                    $formatted = match ($item) {
                        'presencial' => 'Presencial',
                        'remoto' => 'Remoto',
                        'semipresencial' => 'Semipresencial',
                        default => ucfirst($item)
                    };
                    return [$item => $formatted];
                });
                
        
                // Obtener todos los ciclos únicos desde la relación practica
                $ciclosRaw = Practica::select('cicloFormativo')->distinct()->pluck('cicloFormativo')->toArray();
        
                $ciclos = collect($ciclosRaw)->mapWithKeys(function ($item) {
                    return [$item => $item];
                });
                
                // Obtener valores únicos de plazas
                $plazasRaw = Practica::select('numPlazasAsignadas')->distinct()->pluck('numPlazasAsignadas')->sort()->toArray();
                $plazas = collect($plazasRaw)->mapWithKeys(fn($item) => [$item => $item]);
                $provincias_raw = Empresa::select('provincia')->distinct()->pluck('provincia')->filter();
                $provincia = $provincias_raw->mapWithKeys(function ($id) {
                    return [$id => $this->provinciaToString($id)];
                });
        

        return view('pages/empresa/empresa-index', compact('empresas',            
        'familias',
        'colaboraciones',
        'modalidades',
        'ciclos',
        'plazas',
        'provincia'
    ));
    }
        


    public function saveData()
    {
        \Log::info(session('empresa_draft'));
        try {
            if (session()->has('empresa_draft')) {
                session('empresa_draft')->save();
            }

            if (session()->has('responsableConvenio_draft')) {
                foreach(session('responsableConvenio_draft') as $rc) {
                    $rc->empresa_id = session('empresa_draft')->id; // Set FK
                    $rc->save();
                }
            }

            if (session()->has('centroTrabajo_draft')) {
                session('centroTrabajo_draft')->empresa_id = session('empresa_draft')->id; // Set FK
                session('centroTrabajo_draft')->save();
            }

            if (session()->has('personaContacto_draft')) {
                foreach(session('personaContacto_draft') as $pc) {
                    $pc->id_centrosTrabajo = session('centroTrabajo_draft')->id; // Set FK
                    $pc->save();
                }
            }

            if (session()->has('practica_draft')) {
                session('practica_draft')->empresa_id = session('empresa_draft')->id; // Set FK
                session('practica_draft')->save();
            }

            if (session()->has('tutor_draft')) {
                foreach(session('tutor_draft') as $tutor) {
                    $tutor->id_practica = session('practica_draft')->id; // Set FK
                    $tutor->save();
                }
            }

            if (session()->has('tutorEmpresa_draft')) {
                foreach(session('tutorEmpresa_draft') as $tutorEmpresa) {
                    $tutorEmpresa->id_practica = session('practica_draft')->id; // Set FK
                    $tutorEmpresa->save();
                }
            }
        } catch (\Exception $e) {
            \Log::error('Save failed: '.$e->getMessage());
            throw $e; // Re-throw or handle gracefully
        }
    }

    public function submit($currentForm, $action, $filled)
    {
        \Log::info($action);
        
        $previousForm = intval(explode('-', $currentForm)[2]) - 1;
        $nextForm = intval(explode('-', $currentForm)[2]) + 1;

        // Acciones del formulario
        switch ($action) {
            case 'publish':
                $this->saveData();
                session()->forget([
                    'empresa_draft',
                    'responsableConvenio_draft',
                    'centroTrabajo_draft',
                    'personaContacto_draft',
                    'practica_draft',
                    'tutor_draft',
                    'tutorEmpresa_draft'
                ]);
                return redirect('empresa-index')->with('status', 'La empresa se ha añadido corectamente');
                break;

            case 'save_draft':
                return redirect('empresa-index')->with('status', 'El draft se ha guardado');
                break;
            
            // TODO: Implement this back later to validate through controller -> add novalidate to form
            case 'exit':            
                // Check if a form is filled or not
                if ($filled) {
                    return redirect('empresa-index')->with('status', 'El draft se ha guardado');
                } else {
                    return redirect('empresa-index');
                }
                break;

            case 'next_page':
                \Log::info('Going to: empresa-form-' . $nextForm);
                return redirect(route('empresa-form-' . $nextForm));
                break;

            // case 'prev_page':
            //     \Log::info('Going to: empresa-form-' . $previousForm);
            //     return redirect(route('empresa-form-' . $previousForm));
            //     break;

            default:
                return redirect('empresa-index')->with('status', 'Ha ocurrido un error');
        }
    }

    public function store_1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cif' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'colaboracion' => 'nullable|string|max:255',
            'gestiones_prospeccion' => 'nullable|string|max:255',
            'gestiones_colaboracion' => 'nullable|string|max:255',
            'modalidad' => 'nullable|string|max:255',
            'ofertaLaboral' => 'nullable|string|max:255',
            'entidad' => 'nullable|string|max:255',
            'comunidad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'codigoPostal' => 'nullable|string|digits:5',
            'familiaPersonal' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);
        $responsableCount = $request->input('responsable_count', 0);


        // ResponsableConvenio Validator
        // TODO: true to condition if 1 rc exists, change to condition like foreach inside to  
        if (
            $request->filled('rc_dni') || $request->filled('rc_nombre') || $request->filled('rc_apellido') || $request->filled('rc_telefono') || $request->filled('rc_email')
        ) {
            $validator->sometimes('rc_dni', 'required|string|max:255', fn () => true);
            $validator->sometimes('rc_nombre', 'required|string|max:255', fn () => true);
            $validator->sometimes('rc_apellido', 'required|string|max:255', fn () => true);
            $validator->sometimes('rc_telefono', 'nullable|string|digits:9', fn () => true);
            $validator->sometimes('rc_email', 'nullable|string|email', fn () => true);
        }
        

        // Return errors
        if ($validator->fails()) {
            if ($request->input('action') === 'exit') {
                return $this->submit('empresa-form-1', 'exit', false);
            }

            return back()->withErrors($validator)->withInput();
        }

        if ($request->cif && $request->nombre) {
            $empresa = new Empresa;
            $empresa->cif = $request->cif;
            $empresa->nombre = $request->nombre;
            $empresa->colaboracion = $request->colaboracion;
            if ($request->colaboracion === 'prospeccion') {
                $empresa->gestiones = $request->gestiones_prospeccion;
            } elseif ($request->colaboracion === 'colaboracion') {
                $empresa->gestiones = $request->gestiones_colaboracion;
            } else {
                $empresa->gestiones = null;
            }
            $empresa->modalidad = $request->modalidad;
            $empresa->ofertaLaboral = $request->ofertaLaboral;
            $empresa->entidad = $request->entidad;
            $empresa->comunidad = $request->comunidad;
            $empresa->provincia = $request->provincia;
            $empresa->municipio = $request->municipio;
            $empresa->direccion = $request->direccion;
            $empresa->codigoPostal = $request->codigoPostal;
            $empresa->familiaPersonal = $request->familiaPersonal;
            $empresa->observaciones = $request->observaciones;
            session(['empresa_draft' => $empresa]);
        }

        // ResponsableConvenio
        for ($i = 1; $i <= $request->responsable_count; $i++)  {
            $dni = $request->input("rc_dni_$i");
            $nombre = $request->input("rc_nombre_$i");
            $apellido = $request->input("rc_apellido_$i");
            
            // Only create if required fields are present
            if ($dni && $nombre && $apellido) {
                $rc = new ResponsableConvenio;
                $rc->dni = $dni;
                $rc->nombre = $nombre;
                $rc->apellido = $apellido;
                $rc->telefono = $request->input("rc_telefono_$i");
                $rc->email = $request->input("rc_email_$i");

                $responsables[] = $rc;

                session(['responsableConvenio_draft' => $responsables]);
            }
        }

        \Log::debug('Artisan Session Check:', session()->all());
        return $this->submit('empresa-form-1', ($request->has('action') ? $request->input('action') : 'null'), true);
    }

    public function store_2(Request $request)
    {
        if ($request->input('action') === 'exit') {
            return $this->submit('empresa-form-1', 'exit', false);
        }

        if ($request->input('action') === 'prev_page') {
            $previousForm = intval(explode('-', 'empresa-form-2')[2]) - 1;
            
            \Log::info('Going to: empresa-form-' . $previousForm);
            return redirect(route('empresa-form-' . $previousForm));
        }

        // CentroTrabajo
        $validator = Validator::make($request->all(), [
            'direccion' => 'nullable|string|max:255',
            'codigoPostal' => 'nullable|string|digits:5',
            'comunidad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
        ]);

        // PersonaContacto Validator
        // TODO: true to condition if 1 rc exists, change to condition like foreach inside to  
        if (
            $request->filled('pc_dni') || $request->filled('pc_nombre') || $request->filled('pc_apellido') || $request->filled('pc_telefono') || $request->filled('pc_email')
        ) {
            $validator->sometimes('pc_dni', 'required|string|max:255', function () {return true;});
            $validator->sometimes('pc_nombre', 'required|string|max:255', function () {return true;});
            $validator->sometimes('pc_apellido', 'required|string|max:255', function () {return true;});
            $validator->sometimes('pc_telefono', 'nullable|integer|digits:9', function () {return true;});
            $validator->sometimes('pc_email', 'nullable|string|email', function () {return true;});
        }

        if ($validator->fails()) {
            if ($request->input('action') === 'exit') {
                return $this->submit('empresa-form-1', 'exit', false);
            }

            return back()->withErrors($validator)->withInput();
        }

        $centroTrabajo = new CentroTrabajo;
        $centroTrabajo->codigoPostal = $request->codigoPostal;
        $centroTrabajo->comunidad = $request->comunidad;
        $centroTrabajo->provincia = $request->provincia;
        $centroTrabajo->municipio = $request->municipio;
        $centroTrabajo->direccion = $request->direccion;
        session(['centroTrabajo_draft' => $centroTrabajo]);

        // Submit
        \Log::debug('Artisan Session Check:', session()->all());
        return $this->submit('empresa-form-2', ($request->has('action') ? $request->input('action') : 'null'), true);
    }

    public function store_3(Request $request)
    {
        // if ($request->input('action') === 'prev_page') {
        //     $previousForm = intval(explode('-', 'empresa-form-3')[2]) - 1;
            
        //     \Log::info('Going to: empresa-form-' . $previousForm);
        //     return redirect(route('empresa-form-' . $previousForm));
        // }

        // Exit does not save 
        if ($request->input('action') === 'exit') {
            return $this->submit('empresa-form-1', 'exit', false);
        }

        // Practica
        $validator = Validator::make($request->all(), [
            'numPlazasAsignadas' => 'nullable|integer',
            'cicloFormativo' => 'nullable|string|max:255',
            'cursoAcademico' => 'nullable|string|max:255',
            'periodoFrom' => 'nullable|date',
            'periodoTo' => 'nullable|date|after_or_equal:periodoFrom',
            'horarioFrom' => 'nullable|string|max:255',
            'horarioTo' => 'nullable|string|max:255',
            'convenioMarco' => 'nullable|string|max:255',
            'usoLogos' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        // Tutor Validator
        // TODO: true to condition if 1 rc exists, change to condition like foreach inside to  
        if (
            $request->filled('tutor_dni') || $request->filled('tutor_nombre') || $request->filled('tutor_apellido') || $request->filled('tutor_telefono') || $request->filled('tutor_email')
        ) {
            $validator->sometimes('tutor_dni', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutor_nombre', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutor_apellido', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutor_telefono', 'nullable|integer|digits:9', function () {return true;});
            $validator->sometimes('tutor_email', 'nullable|string|email', function () {return true;});
        }

        // TutorEmpresa Validator
        // TODO: true to condition if 1 rc exists, change to condition like foreach inside to  
        if (
            $request->filled('tutorEmpresa_dni') || $request->filled('tutorEmpresa_nombre') || $request->filled('tutorEmpresa_apellido') || $request->filled('tutorEmpresa_telefono') || $request->filled('tutorEmpresa_email')
        ) {
            $validator->sometimes('tutorEmpresa_dni', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutorEmpresa_nombre', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutorEmpresa_apellido', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutorEmpresa_telefono', 'nullable|integer|digits:9', function () {return true;});
            $validator->sometimes('tutorEmpresa_email', 'nullable|string|email', function () {return true;});
        }
        

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $practica = new Practica;
        $practica->cicloFormativo = $request->cicloFormativo;
        $practica->cursoAcademico = $request->cursoAcademico;
        $practica->numPlazasAsignadas = $request->numPlazasAsignadas;
        $practica->periodoFrom = $request->periodoFrom;
        $practica->periodoTo = $request->periodoFrom;
        $practica->horarioFrom = $request->horarioFrom;
        $practica->horarioTo = $request->horarioTo;
        $practica->convenioMarco = $request->convenioMarco;
        $practica->usoLogos = $request->usoLogos;
        $practica->observaciones = $request->observaciones;
        $practica->tecnicoGestion = Auth::user()->id;
        session(['practica_draft' => $practica]);

        // Tutor
        for ($i = 1; $i <= $request->tutor_count; $i++)  {
            // Only create if required fields are present
            if ($request->input("tutor_dni_$i") && $request->input("tutor_nombre_$i") && $request->input("tutor_apellido_$i")) {
                $tutor = new Tutor;
                $tutor->dni = $request->input("tutor_dni_$i");
                $tutor->nombre = $request->input("tutor_nombre_$i");
                $tutor->apellido = $request->input("tutor_apellido_$i");
                $tutor->telefono = $request->input("tutor_telefono_$i");
                $tutor->email = $request->input("tutor_email_$i");

                $tutoresA[] = $tutor;

                session(['tutor_draft' => $tutoresA]);
            }
        }

        for ($i = 1; $i <= $request->tutorEmpresa_count; $i++)  {
            // Only create if required fields are present
            if ($request->input("tutorEmpresa_dni_$i") && $request->input("tutorEmpresa_nombre_$i") && $request->input("tutorEmpresa_apellido_$i")) {
                $tutorEmpresa = new TutorEmpresa;
                $tutorEmpresa->dni = $request->input("tutorEmpresa_dni_$i");
                $tutorEmpresa->nombre = $request->input("tutorEmpresa_nombre_$i");
                $tutorEmpresa->apellido = $request->input("tutorEmpresa_apellido_$i");
                $tutorEmpresa->telefono = $request->input("tutorEmpresa_telefono_$i");
                $tutorEmpresa->email = $request->input("tutorEmpresa_email_$i");

                $tutoresE[] = $tutorEmpresa;

                session(['tutorEmpresa_draft' => $tutoresE]);
            }
        }

        // Submit
        return $this->submit('empresa-form-3', ($request->has('action') ? $request->input('action') : 'null'), true);
    }
}
