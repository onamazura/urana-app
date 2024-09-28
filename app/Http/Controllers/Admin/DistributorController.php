<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        // Logic for distributor page
        return view('admin.distributors.index');
    }
}
