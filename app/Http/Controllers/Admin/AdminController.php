<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Distributor;
class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::count(); // Menggunakan 'productCount' untuk membedakan dengan $products
        $users = User::count();
        $distributors = Distributor::count();
        $productsall = Product::all(); // Mengambil semua data produk untuk ditampilkan di dashboard

        return view('pages.admin.index', compact('products', 'users', 'distributors', 'productsall'));
    }

    // public function indexInAdmin()
    // {
    //     $products = Product::all();
    //     return view('pages.admin.index', compact('products'));
    // }
}