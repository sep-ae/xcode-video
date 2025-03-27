<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::select('id', 'name', 'email', 'status', 'created_at')
        ->with('roles') 
        ->get();

        return Inertia::render('User/Index', [
            'users' => $users
        ]);
    }
}
