<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\ResponsableConvenio;

class EmpresaUpdateController extends Controller
{
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

    public function update_rc(Request $request, $id)
    {
        $responsable = ResponsableConvenio::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'email' => 'nullable|string|email',
        ]);

        $responsable->update($validated);

        return redirect()->back()->with('success', 'Responsable actualizado correctamente');
    }

    public function delete_rc(Request $request, $id)
    {
        $responsable = ResponsableConvenio::findOrFail($id);
        $responsable->delete();
        
        return response()->back()->with('success', 'Responsable eliminado correctamente');
    }
}
