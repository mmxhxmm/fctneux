<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EmpresaController;

class DraftController extends Controller
{
    public function clearDrafts(Request $request)
    {
        $previousUrl = session('_previous.url');
        $prevPage = last(explode('/', $previousUrl));
        \Log::info('Previous page: ' . $prevPage);
        
        switch ($prevPage) {
            case 'pagina-1':
                $request->session()->forget([
                    'empresa_draft',
                    'responsableConvenio_draft',
                ]);
                \Log::info('Deleted page 1 vars');
                break;
            case 'pagina-2':
                $request->session()->forget([
                    'centroTrabajo_draft',
                    'personaContacto_draft',
                ]);
                \Log::info('Deleted page 2 vars');
                break;
            case 'pagina-3':
                $request->session()->forget([
                    'practica_draft',
                    'tutor_draft',
                    'tutorEmpresa_draft'
                ]);
                \Log::info('Deleted page 3 vars');
                break;
        }
        
        return response()->json(['success' => true]);
    }
}
