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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('pages/empresa-index', compact('empresas'));
    }
    
    public function index_2(Request $request)
    {
        // Get the 'id' from the query parameter
        $id = $request->query('id');

        // Fetch all empresas
        $empresas = Empresa::all();

        // Pass the empresas and the id to the view
        return view('pages/detail-view', [
            'page' => 'empresa-detail',
        ],  compact('empresas' , 'id') );
    }
    
    public function index_3(Request $request)
    {
        $query = $request->input('search');

        $empresas = Empresa::query()
            ->when($query, function ($q) use ($query) {
                $q->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('colaboracion', 'like', '%' . $query . '%')
                ->orWhere('modalidad', 'like', '%' . $query . '%')
                ->orWhere('ofertaLaboral', 'like', '%' . $query . '%')
                ->orWhere('municipio', 'like', '%' . $query . '%')
                ->orWhere('familiaPersonal', 'like', '%' . $query . '%')
                ->orWhereHas('practica', function ($subQuery) use ($query) {
                    $subQuery->where('cicloFormativo', 'like', '%' . $query . '%');
                });
            })
            ->get();

        return view('pages.empresa-index', compact('empresas'));
    }

    public function index_4(Request $request)
{
    $query = $request->input('search');
    $provincia = $request->input('provincia');

    $empresas = Empresa::query()
        ->when($query, function ($q) use ($query) {
            $q->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('colaboracion', 'like', '%' . $query . '%')
                ->orWhere('modalidad', 'like', '%' . $query . '%')
                ->orWhere('ofertaLaboral', 'like', '%' . $query . '%')
                ->orWhere('municipio', 'like', '%' . $query . '%')
                ->orWhere('familiaPersonal', 'like', '%' . $query . '%')
                ->orWhereHas('practica', function ($subQuery) use ($query) {
                    $subQuery->where('cicloFormativo', 'like', '%' . $query . '%');
                });
        })
        ->when($provincia, function ($q) use ($provincia) {
            $q->where('provincia', $provincia);
        })
        ->get();

    return view('pages.empresa-index', compact('empresas'));
}


    public function saveData()
    {
        \Log::info(session('empresa_draft'));
        try {
            if (session()->has('empresa_draft')) {
                session('empresa_draft')->save();
            }

            if (session()->has('responsableConvenio_draft')) {
                session('responsableConvenio_draft')->empresa_id = session('empresa_draft')->id; // Set FK
                session('responsableConvenio_draft')->save();
            }

            if (session()->has('centroTrabajo_draft')) {
                session('centroTrabajo_draft')->empresa_id = session('empresa_draft')->id; // Set FK
                session('centroTrabajo_draft')->save();
            }

            if (session()->has('personaContacto_draft')) {
                session('personaContacto_draft')->id_centrosTrabajo = session('centroTrabajo_draft')->id; // Set FK
                session('personaContacto_draft')->save();
            }

            if (session()->has('practica_draft')) {
                session('practica_draft')->empresa_id = session('empresa_draft')->id; // Set FK
                session('practica_draft')->save();
            }

            if (session()->has('tutor_draft')) {
                session('tutor_draft')->id_practica = session('practica_draft')->id; // Set FK
                session('tutor_draft')->save();
            }

            if (session()->has('tutorEmpresa_draft')) {
                session('tutorEmpresa_draft')->id_practica = session('practica_draft')->id; // Set FK
                session('tutorEmpresa_draft')->save();
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

        // ResponsableConvenio Validator
        // TODO: true to condition if 1 rc exists, change to condition like foreach inside to  
        if (true) {
            $validator->sometimes('rc_dni', 'required|string|max:255', function () {return true;});
            $validator->sometimes('rc_nombre', 'required|string|max:255', function () {return true;});
            $validator->sometimes('rc_apellido', 'required|string|max:255', function () {return true;});
            $validator->sometimes('rc_telefono', 'nullable|integer|digits:9', function () {return true;});
            $validator->sometimes('rc_email', 'nullable|string|email', function () {return true;});
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
        if ($request->rc_dni && $request->rc_nombre && $request->rc_apellido) {
            $rc = new ResponsableConvenio;
            $rc->dni = $request->rc_dni;
            $rc->nombre = $request->rc_nombre;
            $rc->apellido = $request->rc_apellido;
            $rc->telefono = $request->rc_telefono;
            $rc->email = $request->rc_email;
            session(['responsableConvenio_draft' => $rc]);
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
            'comunidad' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'municipio' => 'nullable|string|max:255',
        ]);

        // PersonaContacto Validator
        // TODO: true to condition if 1 rc exists, change to condition like foreach inside to  
        if (true) {
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

        // PersonaContacto
        if ($request->pc_dni && $request->pc_nombre && $request->pc_apellido) {
            $pc = new PersonaContacto;
            $pc->dni = $request->pc_dni;
            $pc->nombre = $request->pc_nombre;
            $pc->apellido = $request->pc_apellido;
            $pc->telefono = $request->pc_telefono;
            $pc->email = $request->pc_email;
            session(['personaContacto_draft' => $pc]);
        }

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
        if (true) {
            $validator->sometimes('tutor_dni', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutor_nombre', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutor_apellido', 'required|string|max:255', function () {return true;});
            $validator->sometimes('tutor_telefono', 'nullable|integer|digits:9', function () {return true;});
            $validator->sometimes('tutor_email', 'nullable|string|email', function () {return true;});
        }

        // TutorEmpresa Validator
        // TODO: true to condition if 1 rc exists, change to condition like foreach inside to  
        if (true) {
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
        $practica->horarioFrom = $request->horarioFrom;
        $practica->horarioTo = $request->horarioTo;
        $practica->convenioMarco = $request->convenioMarco;
        $practica->usoLogos = $request->usoLogos;
        $practica->observaciones = $request->observaciones;
        $practica->tecnicoGestion = Auth::user()->id;
        session(['practica_draft' => $practica]);

        // Tutor
        if ($request->tutor_dni && $request->tutor_nombre && $request->tutor_apellido) {
            $tutor = new Tutor;
            $tutor->dni = $request->tutor_dni;
            $tutor->nombre = $request->tutor_nombre;
            $tutor->apellido = $request->tutor_apellido;
            $tutor->telefono = $request->tutor_telefono;
            $tutor->email = $request->tutor_email;
            session(['tutor_draft' => $tutor]);
        }

        // TutorEmpresa
        if ($request->tutorEmpresa_dni && $request->tutorEmpresa_nombre && $request->tutorEmpresa_apellido) {
            $tutorEmpresa = new TutorEmpresa;
            $tutorEmpresa->dni = $request->tutorEmpresa_dni;
            $tutorEmpresa->nombre = $request->tutorEmpresa_nombre;
            $tutorEmpresa->apellido = $request->tutorEmpresa_apellido;
            $tutorEmpresa->telefono = $request->tutorEmpresa_telefono;
            $tutorEmpresa->email = $request->tutorEmpresa_email;
            session(['tutorEmpresa_draft' => $tutorEmpresa]);
        }

        // Submit
        return $this->submit('empresa-form-3', ($request->has('action') ? $request->input('action') : 'null'), true);
    }
}
