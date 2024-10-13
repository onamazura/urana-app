<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User; // Import model User
use App\Models\FlashSale;
use RealRashid\SweetAlert\Facades\Alert; // Import untuk Alert

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua produk
        $flash_sales = FlashSale::with('product')->where('start_time', '<=', now())->where('end_time', '>=', now())->get();
        $products = Product::all();  // Data produk yang ingin ditampilkan
        
        return view('pages.user.index', compact('flash_sales', 'products'));
    }

    public function detail_product($id)
    {
        // Ambil produk berdasarkan ID
        $product = Product::find($id);

        // Periksa jika produk tidak ditemukan
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        // Tampilkan halaman detail produk
        return view('pages.user.detail', compact('product'));
    }

    public function purchase($productId, $userId)
    {
        // Temukan produk dan pengguna
        $product = Product::findOrFail($productId);
        $user = User::findOrFail($userId);

        // Periksa apakah pengguna memiliki cukup poin
        if ($user->point >= $product->price) {
            $totalPoints = $user->point - $product->price;

            // Perbarui poin pengguna
            $user->update([
                'point' => $totalPoints,
            ]);

            Alert::success('Berhasil!', 'Produk berhasil dibeli!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Point anda tidak cukup!');
            return redirect()->back();
        }
    }

    public function flashSaleProducts()
    {
        // Ambil produk yang sedang dalam flash sale
        $flashSales = FlashSale::with('product')
            ->where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->get();

        return view('pages.user.flash_sales.index', compact('flashSales'));
    }
}
