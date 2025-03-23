<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
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
}