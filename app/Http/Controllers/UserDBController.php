<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserDBController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = DB::select('select * from users');

        // Pass the users to the view
        return view('admin/test', compact('users'));
    }
}