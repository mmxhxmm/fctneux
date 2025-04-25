<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TareaController extends Controller
{
    // public function index()
    // {
    //     $tareas = Tarea::all()->reverse();

    //     // Get unique "asignado" values
    //     $asignadoRaw = Tarea::select('asignado')->distinct()->pluck('asignado')->filter()->toArray();

    //     $asignados = collect($asignadoRaw)->mapWithKeys(function ($item) {
    //         return [$item => $item]; // No formatting logic, just display actual name
    //     });

    //         // Estados: desde la constante del modelo
    //     $estados = Tarea::ESTADOS;

    //     // Fechas límite únicas, formateadas
    //     $fechasRaw = Tarea::select('fecha_limite')->distinct()->pluck('fecha_limite')->filter()->sort()->toArray();
    //     $fechas_limite = collect($fechasRaw)->mapWithKeys(function ($date) {
    //         $formatted = \Carbon\Carbon::parse($date)->format('Y-m-d');
    //         return [$formatted => $formatted];
    //     });

    //     // Empresas: ID + Nombre
    //     $empresaRaw = Tarea::select('id', 'nombre')->distinct()->get();
    //     $empresas = $empresaRaw->pluck('nombre', 'id'); // [id => nombre]

    //     return view('pages/tareas-index', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
    // }

    public function index()
    {
        $user = Auth::user(); // Obtén al usuario autenticado
    
        // Obtener solo las tareas asignadas al usuario actual
        // $tareas = Tarea::whereRaw("FIND_IN_SET(?, asignado)", [$user->name])->get();
        $tareas = Tarea::where('asignado', $user->name)->get();
    
        // Asegúrate de ordenar las tareas por fecha límite o como prefieras
        $tareas = $tareas->sortByDesc('fecha_limite'); // Ordenar por fecha límite descendente
    
        // Verifica si hay tareas asignadas
        // dd($tareas->toArray()); // Convierte la colección a un array y visualiza los datos
        // dd($user->name);  // Esto te muestra el nombre del usuario que se está utilizando para filtrar
        // dd(get_class($tareas)); // Esto te debería devolver 'Illuminate\Database\Eloquent\Collection'

        // El resto del código sigue igual...
        $asignadoRaw = Tarea::select('asignado')->distinct()->pluck('asignado')->filter()->toArray();
    
        $asignados = collect($asignadoRaw)->mapWithKeys(function ($item) {
            return [$item => $item]; // No formatting logic, just display actual name
        });
    
        $estados = Tarea::ESTADOS;
    
        $fechasRaw = Tarea::select('fecha_limite')->distinct()->pluck('fecha_limite')->filter()->sort()->toArray();
        $fechas_limite = collect($fechasRaw)->mapWithKeys(function ($date) {
            $formatted = \Carbon\Carbon::parse($date)->format('Y-m-d');
            return [$formatted => $formatted];
        });
    
        $empresaRaw = Tarea::select('id', 'nombre')->distinct()->get();
        $empresas = $empresaRaw->pluck('nombre', 'id'); // [id => nombre]
    
        return view('pages/tareas-index', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
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
        $tarea->fecha_limite = $request->fecha_limite;
        $tarea->empresa_id = 1; 
        $tarea->save();
    
        return redirect()->back()->with('success', 'Tarea añadida correctamente');
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
    

        return view('pages/tareas-index', compact('tareas', 'asignados', 'estados', 'fechas_limite', 'empresas'));
    }
    
}