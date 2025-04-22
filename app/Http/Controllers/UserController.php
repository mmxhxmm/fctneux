<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function all()
    {
        // Fetch all users from the database
        $users = User::all();

        // Pass the users to the view
        return view('profile/perfil', compact('users'));
    }

    public function active()
    {
        // Fetch all users from the database
        $users = User::all()->where('situacion', 'Alta');
        $state = 'activo';

        // Pass the users to the view
        return view('admin/personal-index', compact('users', 'state'));
    }

    public function no_active()
    {
        // Fetch all users from the database
        $users = User::all()->where('situacion', 'Baja');
        $state = 'no-activo';

        // Pass the users to the view
        return view('admin/personal-index', compact('users', 'state'));
    }
    public function search(Request $request)
{
    $query = $request->input('search');

    $users = User::query()
        ->where('situacion', 'Alta')
        ->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('email', 'like', '%' . $query . '%')
              ->orWhere('municipio', 'like', '%' . $query . '%')
              ->orWhere('role', 'like', '%' . $query . '%');
        })
        ->get();

    $state = 'activo';
    return view('admin/personal-index', compact('users', 'state'));
}

}