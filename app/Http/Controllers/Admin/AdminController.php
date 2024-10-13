<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Distributor;


class AdminController extends Controller
{
    // Method for showing the dashboard
    public function dashboard()
    {
        // Counting the number of products, users, and distributors
        $productCount = Product::count();
        $userCount = User::count();
        $distributorCount = Distributor::count();
        
        // Passing counted data to the view
        return view('pages.admin.index', compact('productCount', 'userCount', 'distributorCount'));
    }

    // Method to show a specific user by ID
    public function show($id)
    {
        // Find user by ID
        $user = User::find($id);

        // If user not found, return a 404 error
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // If user found, pass the user to the view
        return view('users.show', compact('user'));
    }
}
