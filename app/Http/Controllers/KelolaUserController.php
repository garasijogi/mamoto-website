<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class KelolaUserController extends Controller
{
    public function index()
    {
        return view('admin.user', ['users' => User::latest()->limit(10)->get()]);
    }
}
