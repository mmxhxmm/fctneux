<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Empresa;
use App\Models\ResponsableConvenio;
use App\Models\CentroTrabajo;
use App\Models\PersonaContacto;
use App\Models\Practica;
use App\Models\Tutor;
use App\Models\TutorEmpresa;

class EmpresaUpdateController extends Controller
{
    // Empresa
    public function update_empresa(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $validated = $request->validate([
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

        if ($request->colaboracion === 'prospeccion') {
            $empresa->gestiones = $request->gestiones_prospeccion;
        } elseif ($request->colaboracion === 'colaboracion') {
            $empresa->gestiones = $request->gestiones_colaboracion;
        } else {
            $empresa->gestiones = null;
        }

        $empresa->update($validated);

        return redirect()->back()->with('success', 'Empresa actualizado correctamente');
    }

    public function delete_empresa(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        
        return response()->back()->with('success', 'Empresa eliminado correctamente');
    }


    // Responsable Convenio
    public function add_rc(Request $request, $empresa_id)
    {
        $validator = Validator::make($request->all(), [
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'email' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $rc = new ResponsableConvenio;
        $rc->dni = $request->dni;
        $rc->nombre = $request->nombre;
        $rc->apellido = $request->apellido;
        $rc->telefono = $request->telefono;
        $rc->email = $request->email;
        $rc->empresa_id = $empresa_id;
        $rc->save();

        return redirect()->back()->with('success', 'Responsable añadido correctamente');
    }

    public function update_rc(Request $request, $id)
    {

        $responsable = ResponsableConvenio::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'email' => 'nullable|string|max:255',
        ]);

        $responsable->update($validated);

        return redirect()->back()->with('success', 'Responsable actualizado correctamente');
    }

    public function delete_rc(Request $request, $id)
    {
        $responsable = ResponsableConvenio::findOrFail($id);
        $responsable->delete();
        
        return back()->with('success', 'Responsable eliminado correctamente');
    }


    // Centro Trabajo
    public function update_ct(Request $request, $id)
    {
        $centroTrabajo = CentroTrabajo::findOrFail($id);

        $validated = $request->validate([
            'direccion' => 'nullable|string|max:255',
            'codigoPostal' => 'nullable|string|digits:5',
            'comunidad' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'municipio' => 'nullable|string|max:255',
        ]);

        $centroTrabajo->update($validated);

        return redirect()->back()->with('success', 'Centro Trabajo actualizado correctamente');
    }

    public function delete_ct(Request $request, $id)
    {
        $centroTrabajo = CentroTrabajo::findOrFail($id);
        $centroTrabajo->delete();
        
        return response()->back()->with('success', 'Centro Trabajo eliminado correctamente');
    }

    // Persona Contacto
    public function update_pc(Request $request, $id)
    {
        $personaContacto = PersonaContacto::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'email' => 'nullable|string|max:255',
        ]);

        $personaContacto->update($validated);

        return redirect()->back()->with('success', 'Persona Contacto actualizado correctamente');
    }

    public function delete_pc(Request $request, $id)
    {
        $personaContacto = PersonaContacto::findOrFail($id);
        $personaContacto->delete();
        
        return response()->back()->with('success', 'Persona Contacto eliminado correctamente');
    }


    // Practica
    public function update_practica(Request $request, $id)
    {
        $practica = Practica::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'email' => 'nullable|string|email',
        ]);

        $practica->update($validated);

        return redirect()->back()->with('success', 'Practica actualizado correctamente');
    }

    public function delete_practica(Request $request, $id)
    {
        $practica = Practica::findOrFail($id);
        $practica->delete();
        
        return response()->back()->with('success', 'Practica eliminado correctamente');
    }


    // Tutor
    public function update_tutor(Request $request, $id)
    {
        $tutor = Tutor::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'email' => 'nullable|string|email',
        ]);

        $tutor->update($validated);

        return redirect()->back()->with('success', 'Tutor actualizado correctamente');
    }

    public function delete_tutor(Request $request, $id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->delete();
        
        return response()->back()->with('success', 'Tutor eliminado correctamente');
    }


    // Tutor Empresa
    public function update_tutor_empresa(Request $request, $id)
    {
        $tutorEmpresa = TutorEmpresa::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'email' => 'nullable|string|email',
        ]);

        $tutorEmpresa->update($validated);

        return redirect()->back()->with('success', 'TutorEmpresa actualizado correctamente');
    }

    public function delete_tutor_empresa(Request $request, $id)
    {
        $tutorEmpresa = TutorEmpresa::findOrFail($id);
        $tutorEmpresa->delete();
        
        return response()->back()->with('success', 'TutorEmpresa eliminado correctamente');
    }
}
