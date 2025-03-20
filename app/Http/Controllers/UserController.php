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
        $users = User::all()->where('situacion', 'alta');

        // Pass the users to the view
        return view('admin/personal-activo', compact('users'));
    }

    public function no_active()
    {
        // Fetch all users from the database
        $users = User::all()->where('situacion', 'baja');

        // Pass the users to the view
        return view('admin/personal-no-activo', compact('users'));
    }
}