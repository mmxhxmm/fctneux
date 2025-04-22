<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarea;
use App\Models\User;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::all()->reverse();

        // Get unique "asignado" values
        $asignadoRaw = Tarea::select('asignado')->distinct()->pluck('asignado')->filter()->toArray();

        $asignados = collect($asignadoRaw)->mapWithKeys(function ($item) {
            return [$item => $item]; // No formatting logic, just display actual name
        });

            // Estados: desde la constante del modelo
        $estados = Tarea::ESTADOS;

        // Fechas límite únicas, formateadas
        $fechasRaw = Tarea::select('fecha_limite')->distinct()->pluck('fecha_limite')->filter()->sort()->toArray();
        $fechas_limite = collect($fechasRaw)->mapWithKeys(function ($date) {
            $formatted = \Carbon\Carbon::parse($date)->format('Y-m-d');
            return [$formatted => $formatted];
        });

        // Empresas: ID + Nombre
        $empresaRaw = Tarea::select('id', 'nombre')->distinct()->get();
        $empresas = $empresaRaw->pluck('nombre', 'id'); // [id => nombre]

        return view('pages/tareas-index', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'asignado' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'fecha_limite' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $asignadoArray = explode(',', $request->asignado);
        $asignadosSelected = '';

        foreach ($asignadoArray as $asignadoID) {
            \Log::info($asignadoID);

            if (User::where('id', $asignadoID)->exists()) {
                $user = User::find($asignadoID);
                \Log::info($user);

                $asignadosSelected .= $user->name;

                $asignadosSelected .= ', ';
            }
        }
        $asignadosSelected = substr_replace($asignadosSelected, '', -2);

        $tarea = new Tarea;
        $tarea->nombre = $request->nombre;
        $tarea->asignado = $asignadosSelected;
        $tarea->estado = $request->estado;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_limite = $request->fecha_limite;
        $tarea->empresa_id = 1; // TODO needs multiselect value
        $tarea->save();

        return redirect()->back()->with('success', 'Tarea añadido correctamente');
    }

    public function markAsDone(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->estado = 'done';
        $tarea->save();

        return redirect()->route('tareas-historial')->with('status', 'Tarea marcada como hecha.');
    }
    public function buscar(Request $request)
    {
        $query = $request->input('search');

        $tareas = Tarea::with('empresa')
            ->when($query, function ($q) use ($query) {
                $q->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('asignado', 'like', '%' . $query . '%')
                ->orWhere('descripcion', 'like', '%' . $query . '%')
                ->orWhere('estado', 'like', '%' . $query . '%')
                ->orWhereHas('empresa', function ($q) use ($query) {
                    $q->where('nombre', 'like', '%' . $query . '%');
                });
            })
            ->get();

        return view('pages/tareas-index', compact('tareas'));
    }

    public function asignado_filtro(Request $request)
    {
        $query = Tarea::query();
    
        // Filter by asignado
        if ($request->filled('asignado')) {
            $query->whereIn('asignado', (array) $request->asignado);
        }
    
        // Filter by estado
        if ($request->filled('estado')) {
            $query->whereIn('estado', (array) $request->estado);
        }
    
        // Filter by fecha limite
        if ($request->filled('fecha_limite')) {
            $query->whereIn('fecha_limite', (array) $request->fecha_limite);
        }
    
        // Filter by empresa_id
        if ($request->filled('empresa_id')) {
            $query->whereIn('empresa_id', (array) $request->empresa_id);
        }
    
        $tareas = $query->get();
    
        // Asignado
        $asignadoRaw = Tarea::select('asignado')->distinct()->pluck('asignado')->filter()->toArray();
        $asignados = collect($asignadoRaw)->mapWithKeys(fn($item) => [$item => $item]);
    
        // Estados
        $estados = Tarea::ESTADOS;
    
        // Fecha límite
        $fechasRaw = Tarea::select('fecha_limite')->distinct()->pluck('fecha_limite')->filter()->sort()->toArray();
        $fechas_limite = collect($fechasRaw)->mapWithKeys(fn($date) => [
            \Carbon\Carbon::parse($date)->format('Y-m-d') => \Carbon\Carbon::parse($date)->format('Y-m-d')
        ]);
    
        // Empresas: ID + Nombre
        $empresaRaw = Tarea::select('id', 'nombre')->distinct()->get();
        $empresas = $empresaRaw->pluck('nombre', 'id'); // [id => nombre]
    
        return view('pages/tareas-index', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
    }
}