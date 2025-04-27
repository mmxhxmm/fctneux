<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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

        return view('pages/tarea/tareas-index', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
    }

    public function historial()
    {
        $tareas = Tarea::all()->reverse();

        $asignadoRaw = Tarea::select('asignado')->distinct()->pluck('asignado')->filter()->toArray();

        $asignados = collect($asignadoRaw)->mapWithKeys(function ($item) {
            return [$item => $item];
        });

        $estados = Tarea::ESTADOS;

        $fechasRaw = Tarea::select('fecha_limite')->distinct()->pluck('fecha_limite')->filter()->sort()->toArray();
        $fechas_limite = collect($fechasRaw)->mapWithKeys(function ($date) {
            $formatted = \Carbon\Carbon::parse($date)->format('Y-m-d');
            return [$formatted => $formatted];
        });

        $empresaRaw = Tarea::select('id', 'nombre')->distinct()->get();
        $empresas = $empresaRaw->pluck('nombre', 'id');

        return view('pages/tarea/tareas-historial', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'asignado' => 'nullable|string', 
            'estado' => 'nullable|string|max:255',
            'fecha_limite' => 'nullable|date',
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $asignadoArray = explode(',', $request->asignado);
    
        $asignadosSelected = User::whereIn('id', $asignadoArray)
            ->pluck('name')
            ->implode(', ');

        $tarea = new Tarea;
        $tarea->nombre = $request->nombre;
        $tarea->asignado = $asignadosSelected; 
        $tarea->estado = $request->estado;
        $tarea->descripcion = $request->descripcion;
        $tarea->fecha_limite = $request->fecha_limite ?: null;
        $tarea->empresa_id = 1;
        $tarea->save();
    
        return redirect()->back()->with('success', 'Tarea añadida correctamente');
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $validator = $request->validate([
            'nombre' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|string|max:255',
            'fecha_limite' => 'nullable|date',
        ]);

        $tarea->asignado = Auth::user()->name; 
        $tarea->empresa_id = 1;
        $tarea->update($validator);

        return redirect()->back()->with('success', 'Tarea actualizado correctamente');
    }
    
    public function update_estado(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->estado = $request->estado;
        $tarea->save();

        if ($request->estado == 'done') {
            return redirect()->route('tareas-historial')->with('success', 'Tarea editada correctamente');
        } else {
            return redirect()->route('tareas-index')->with('success', 'Tarea editada correctamente');
        }
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

        return view('pages/tarea/tareas-index', compact('tareas'));
    }

    public function asignado_filtro(Request $request)
    {
        $query = Tarea::query();
    

        if ($request->filled('asignado')) {
            $asignados = (array) $request->asignado;
    
            $query->where(function ($q) use ($asignados) {
                foreach ($asignados as $asignado) {
                    $q->orWhere('asignado', 'LIKE', '%' . $asignado . '%');
                }
            });
        }
    
        if ($request->filled('estado')) {
            $query->whereIn('estado', (array) $request->estado);
        }
    
        if ($request->filled('fecha_limite')) {
            $query->whereIn('fecha_limite', (array) $request->fecha_limite);
        }
    
        if ($request->filled('empresa_id')) {
            $query->whereIn('empresa_id', (array) $request->empresa_id);
        }
    
        $tareas = $query->get();
    
        $asignadoRaw = Tarea::select('asignado')->distinct()->pluck('asignado')->filter()->toArray();
    
        $asignadoFlat = [];
        foreach ($asignadoRaw as $entry) {
            $names = explode(',', $entry);
            foreach ($names as $name) {
                $asignadoFlat[] = trim($name);
            }
        }
    
        $asignados = collect($asignadoFlat)->unique()->sort()->values();
    

        $estados = Tarea::ESTADOS;
    
        $fechasRaw = Tarea::select('fecha_limite')->distinct()->pluck('fecha_limite')->filter()->sort()->toArray();
        $fechas_limite = collect($fechasRaw)->mapWithKeys(fn($date) => [
            \Carbon\Carbon::parse($date)->format('Y-m-d') => \Carbon\Carbon::parse($date)->format('Y-m-d')
        ]);

        $empresaRaw = Tarea::select('empresa_id')->distinct()->pluck('empresa_id')->filter()->toArray();
        $empresas = \App\Models\Empresa::whereIn('id', $empresaRaw)->pluck('nombre', 'id');
    

        return view('pages/tarea/tareas-index', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
    }
}