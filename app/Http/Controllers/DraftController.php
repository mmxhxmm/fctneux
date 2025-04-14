<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EmpresaController;

class DraftController extends Controller
{
    public function clearDrafts(Request $request)
    {
        $request->session()->forget([
            'empresa_draft',
            'responsableConvenio_draft',
            'centroTrabajo_draft',
            'personaContacto_draft',
            'practica_draft',
            'tutor_draft',
            'tutorEmpresa_draft'
        ]);

        \Log::info('Draft deleteted');
    
        return response()->json(['success' => true]);
    }
}
