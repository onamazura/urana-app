<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

class ListController extends Controller
{
    public function index()
    {
        $admins = admin::all();
        $users = user::all();

        return view('welcome', compact('admins', 'users'));
    }
}