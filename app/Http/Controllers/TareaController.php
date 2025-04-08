<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::all();
        return view('pages/tareas-index', compact('tareas'));
    }

    public function store()
    {
        $tareas = Tarea::all();
        return view('pages/tareas-index');
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



}