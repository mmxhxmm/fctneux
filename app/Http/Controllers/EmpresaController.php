<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\ResponsableConvenio;

class EmpresaController extends Controller
{
    public function index()
    {
        return view('pages/form');
    }

    // Helper function to transform select fields
    private function transformSelect($field, $value, $colaboracion = null) {
        switch ($field) {
            case 'colaboracion':
                return $value === 'prospeccion' ? 'Prospección' : 'Colaboración';
            case 'gestiones':
                switch ($colaboracion) {
                    case 'prospeccion':
                        switch ($value) {
                            case 'primer_contacto':
                                return 'P - Primer contacto';
                            case 'pendente_respuesta':
                                return 'P - Pendente respuesta';
                            case 'volver_contactar':
                                return 'P - Volver a contactar';
                            case 'no_acogen_alumnado':
                                return 'P - No acogen alumnado';
                            default:
                                return $value;
                        }
                    case 'colaboracion':
                        switch ($value) {
                            case 'pendiente_firma_convenio':
                                return 'E - Pendiente firma Convenio';
                            case 'plazas_conseguidas':
                                return 'E - Plazas conseguidas';
                            case 'solicitud_plazas':
                                return 'E - Solicitud plazas';
                            default:
                                return $value;
                        }
                }
                switch ($value) {
                    case 'primer_contacto':
                        return 'P - Primer contacto';
                    case 'pendente_respuesta':
                        return 'P - Pendente respuesta';
                    case 'volver_contactar':
                        return 'P - Volver a contactar';
                    case 'no_acogen_alumnado':
                        return 'P - No acogen alumnado';
                    case 'pendiente_firma_convenio':
                        return 'E - Pendiente firma Convenio';
                    case 'plazas_conseguidas':
                        return 'E - Plazas conseguidas';
                    case 'solicitud_plazas':
                        return 'E - Solicitud plazas';
                    default:
                        return $value;
                }
            case 'modalidad':
                switch ($value) {
                    case 'presencial':
                        return 'Presencial';
                    case 'remoto':
                        return 'Remoto';
                    case 'semipresencial':
                        return 'Semipresencial';
                    default:
                        return $value;
                }
            case 'oferta_laboral':
                return $value === 'si' ? 'Si' : 'No';
            case 'ubicacion':
                switch ($value) {
                    case 'catalunya':
                        return 'Cataluña';
                    case 'fueraDeCatalunya':
                        return 'Fuera de Cataluña';
                    case 'fueraDeEspanya':
                        return 'Fuera de España';
                    default:
                        return $value;
                }
            case 'familiaPersonal':
                switch ($value) {
                    case 'sanidad':
                        return 'Sanidad';
                    case 'informatica':
                        return 'Informática';
                    case 'hostelería':
                        return 'Hostelería';
                    case 'marketing':
                        return 'Marketing';
                    default:
                        return $value;
                }
            default:
                return $value;
        }
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
            'oferta_laboral' => 'nullable|string|max:255',
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
        $empresa->colaboracion = $this->transformSelect('colaboracion', $request->colaboracion);
        if ($request->colaboracion === 'prospeccion') {
            $empresa->gestiones = $this->transformSelect('gestiones', $request->gestiones_prospeccion, 'prospeccion');
        } elseif ($request->colaboracion === 'colaboracion') {
            $empresa->gestiones = $this->transformSelect('gestiones', $request->gestiones_colaboracion, 'colaboracion');
        } else {
            $empresa->gestiones = null;
        }
        $empresa->modalidad = $this->transformSelect('modalidad', $request->modalidad);
        $empresa->oferta_laboral = $this->transformSelect('oferta_laboral', $request->oferta_laboral);
        $empresa->entidad = $request->entidad;
        $empresa->ubicacion = $this->transformSelect('ubicacion', $request->ubicacion);
        $empresa->municipio = $request->municipio;
        $empresa->direccion = $request->direccion;
        $empresa->codigoPostal = $request->codigoPostal;
        $empresa->familiaPersonal = $this->transformSelect('familiaPersonal', $request->familiaPersonal);
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
                // TODO: Ir a lista de empresas con mensaje
                return redirect('/empresa-form#bottom')->with('status', 'La empresa se ha añadido corectamente');
            } elseif ($action === 'next_page') {
                // TODO: Ir a seguiente página
                return redirect('/empresa-form#bottom')->with('status', 'La empresa se ha añadido corectamente');
            }
        }
    }
}
