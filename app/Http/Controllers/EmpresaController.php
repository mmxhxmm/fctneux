<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\ResponsableConvenio;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresa-index', compact('empresas'));
    }

    public function store(Request $request)
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
        $empresa->save();

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
            $rc->empresa_cif = $request->cif;
            $rc->save();
        }

        if ($request->has('action')) {
            $action = $request->input('action');
    
            if ($action === 'save_draft') {
                return redirect('empresa-index')->with('status', 'La empresa se ha añadido corectamente');
            } elseif ($action === 'next_page') {
                // TODO: Ir a seguiente página
                return redirect('empresa-form#bottom')->with('status', 'La empresa se ha añadido corectamente');
            }
        }
    }
}
