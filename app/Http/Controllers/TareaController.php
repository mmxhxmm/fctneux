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
}