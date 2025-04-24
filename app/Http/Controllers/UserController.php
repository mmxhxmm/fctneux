<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function all()
    {
        // Fetch all users from the database
        $users = User::all()->reverse();

        // Pass the users to the view
        return view('profile/usuarioPerfil', compact('users'));
    }

    public function active()
    {
        // Fetch all users from the database
        $users = User::all()->where('situacion', 'alta')->reverse();
        $state = 'activo';

        // Pass the users to the view
        return view('pages/user/personal-index', compact('users', 'state'));
    }

    public function no_active()
    {
        // Fetch all users from the database
        $users = User::all()->where('situacion', 'baja')->reverse();
        $state = 'no-activo';

        // Pass the users to the view
        return view('pages/user/personal-index', compact('users', 'state'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $users = User::query()
            ->where('situacion', 'alta')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('municipio', 'like', '%' . $query . '%')
                ->orWhere('role', 'like', '%' . $query . '%');
            })
            ->get();

        $state = 'activo';
        return view('pages/user/personal-index', compact('users', 'state'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|string|max:255',
            'role' => 'required|string|max:255',
            'telefono' => 'nullable|string|digits:9',
            'situacion' => 'required|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->telefono = $request->telefono;
        $user->situacion = $request->situacion;
        $user->municipio = $request->municipio;
        $user->password = $request->password;
        $user->save();

        return redirect()->back()->with('success', 'Usuario añadido correctamente');
    }
}