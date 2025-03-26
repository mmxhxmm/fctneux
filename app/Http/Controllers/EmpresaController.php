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

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('pages/empresa-index', compact('empresas'));
    }

    public function saveData()
    {
        session('empresa_draft')->save();
        session('responsableConvenio_draft') ? session('responsableConvenio_draft')->save() : '';
        session('centroTrabajo_draft') ? session('centroTrabajo_draft')->save() : '';

        if (session('personaContacto_draft')) {
            $personaContactoDraft = session('personaContacto_draft');
            $personaContactoDraft->id_centrosTrabajo = session('centroTrabajo_draft')->id; // Set FK
            $personaContactoDraft->save();
        }

        session('practica_draft') ? session('practica_draft')->save() : '';
        if (session('tutor_draft')) {
            $tutorEmpresaDraft = session('tutor_draft');
            $tutorEmpresaDraft->id_practica = session('practica_draft')->id; // Set FK
            $tutorEmpresaDraft->save();
        }
        if (session('tutorEmpresa_draft')) {
            $tutorEmpresaDraft = session('tutorEmpresa_draft');
            $tutorEmpresaDraft->id_practica = session('practica_draft')->id; // Set FK
            $tutorEmpresaDraft->save();
        }
    }

    public function store_1(Request $request)
    {
        $request->validate([
            'cif' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'colaboracion' => 'nullable|string|max:255',
            'gestiones_prospeccion' => 'nullable|string|max:255',
            'gestiones_colaboracion' => 'nullable|string|max:255',
            'modalidad' => 'nullable|string|max:255',
            'ofertaLaboral' => 'nullable|string|max:255',
            'entidad' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'codigoPostal' => 'nullable|string|max:5',
            'familiaPersonal' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
        ]);

        \Log::info($request->all());

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
        $empresa->ubicacion = $request->ubicacion;
        $empresa->municipio = $request->municipio;
        $empresa->direccion = $request->direccion;
        $empresa->codigoPostal = $request->codigoPostal;
        $empresa->familiaPersonal = $request->familiaPersonal;
        $empresa->observaciones = $request->observaciones;
        session(['empresa_draft' => $empresa]);

        // ResponsableConvenio
        if ($request->rc_dni && $request->rc_nombre && $request->rc_apellido) {
            $request->validate([
                'rc_dni' => 'required|string|max:255',
                'rc_nombre' => 'required|string|max:255',
                'rc_apellido' => 'required|string|max:255',
                'rc_telefono' => 'nullable|integer|size:9',
                'rc_email' => 'nullable|string|email',
            ]);

            $rc = new ResponsableConvenio;
            $rc->dni = $request->rc_dni;
            $rc->nombre = $request->rc_nombre;
            $rc->apellido = $request->rc_apellido;
            $rc->telefono = $request->rc_telefono;
            $rc->email = $request->rc_email;
            $rc->empresa_id = session('empresa_draft')->id;
            session(['responsableConvenio_draft' => $rc]);
        }

        // Submit
        if ($request->has('action')) {
            $action = $request->input('action');
    
            if ($action === 'save_draft') {
                saveData();

                return redirect('empresa-index')->with('status', 'La empresa se ha añadido corectamente');
            } elseif ($action === 'next_page') {
                return redirect(route('empresa-form-2'));
            }
        }
    }

    public function store_2(Request $request)
    {
        // CentroTrabajo
        $validated = $request->validate([
            'direccion' => 'nullable|string|max:255',
            'codigoPostal' => 'nullable|string|max:5',
            'ubicacion' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
        ]);

        $centroTrabajo = new CentroTrabajo;
        $centroTrabajo->direccion = $request->direccion;
        $centroTrabajo->codigoPostal = $request->codigoPostal;
        $centroTrabajo->ubicacion = $request->ubicacion;
        $centroTrabajo->municipio = $request->municipio;
        $centroTrabajo->empresa_id = session('empresa_draft')->id; // Get FK
        session(['centroTrabajo_draft' => $centroTrabajo]);

        // PersonaContacto
        if ($request->pc_dni && $request->pc_nombre && $request->pc_apellido) {
            $request->validate([
                'pc_dni' => 'required|string|max:255',
                'pc_nombre' => 'required|string|max:255',
                'pc_apellido' => 'required|string|max:255',
                'pc_telefono' => 'nullable|integer|size:9',
                'pc_email' => 'nullable|string|email',
            ]);

            $pc = new PersonaContacto;
            $pc->dni = $request->pc_dni;
            $pc->nombre = $request->pc_nombre;
            $pc->apellido = $request->pc_apellido;
            $pc->telefono = $request->pc_telefono;
            $pc->email = $request->pc_email;
            session(['personaContacto_draft' => $pc]);
        }

        // Submit
        if ($request->has('action')) {
            $action = $request->input('action');
    
            if ($action === 'save_draft') {
                saveData();

                return redirect('empresa-index')->with('status', 'La empresa se ha añadido corectamente');
            } elseif ($action === 'next_page') {
                return redirect(route('empresa-form-2'));
            }
        }
    }

    public function store_3(Request $request)
    {
        // Practica
        $validated = $request->validate([
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

        $practica = new Practica;
        $practica->cicloFormativo = $request->cicloFormativo;
        $practica->cursoAcademico = $request->cursoAcademico;
        $practica->periodoFrom = $request->periodoFrom;
        $practica->horarioFrom = $request->horarioFrom;
        $practica->horarioTo = $request->horarioTo;
        $practica->convenioMarco = $request->convenioMarco;
        $practica->usoLogos = $request->usoLogos;
        $practica->observaciones = $request->observaciones;
        $practica->empresa_id = session('empresa_draft')->id; // Get FK
        session(['practica_draft' => $practica]);

        // Tutor
        if ($request->tutor_dni && $request->tutor_nombre && $request->tutor_apellido) {
            $request->validate([
                'tutor_dni' => 'required|string|max:255',
                'tutor_nombre' => 'required|string|max:255',
                'tutor_apellido' => 'required|string|max:255',
                'tutor_telefono' => 'nullable|integer|size:9',
                'tutor_email' => 'nullable|string|email',
            ]);

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
            $request->validate([
                'tutorEmpresa_dni' => 'required|string|max:255',
                'tutorEmpresa_nombre' => 'required|string|max:255',
                'tutorEmpresa_apellido' => 'required|string|max:255',
                'tutorEmpresa_telefono' => 'nullable|integer|size:9',
                'tutorEmpresa_email' => 'nullable|string|email',
            ]);

            $tutorEmpresa = new TutorEmpresa;
            $tutorEmpresa->dni = $request->tutorEmpresa_dni;
            $tutorEmpresa->nombre = $request->tutorEmpresa_nombre;
            $tutorEmpresa->apellido = $request->tutorEmpresa_apellido;
            $tutorEmpresa->telefono = $request->tutorEmpresa_telefono;
            $tutorEmpresa->email = $request->tutorEmpresa_email;
            session(['tutorEmpresa_draft' => $tutorEmpresa]);
        }

        // Submit
        if ($request->has('action')) {
            $action = $request->input('action');
    
            if ($action === 'save_draft') {
                saveData();

                return redirect('empresa-index')->with('status', 'La empresa se ha añadido corectamente');
            } elseif ($action === 'next_page') {
                return redirect(route('empresa-form-2'));
            }
        }
    }
}
