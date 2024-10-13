<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FlashSaleController extends Controller
{
    // Menampilkan semua flash sales
    public function index()
{
    // Mengambil semua flash sale
    $Dflashsales = FlashSale::with('product')->get();
    
    // Mengambil flash sale yang aktif (berdasarkan waktu sekarang)
    $flash_sales = FlashSale::with('product')
        ->where('start_time', '<=', now())
        ->where('end_time', '>=', now())
        ->get();
        
    return view('pages.admin.flash_sales.index', compact('flash_sales', 'Dflashsales'));
}


    // Menampilkan form untuk membuat flash sale
    public function create()
    {
        // Mengambil data produk untuk dipilih
        $products = Product::all();
        return view('pages.admin.flash_sales.create', compact('products'));
    }

    // Menyimpan flash sale baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_price' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Simpan flash sale baru
        FlashSale::create($request->all());

        // Tampilkan pesan sukses
        Alert::success('Berhasil!', 'Flash Sale berhasil dibuat.');
        return redirect()->route('admin.flash_sales');
    }

    
    // Menampilkan form untuk mengedit flash sale
        public function edit($id)
    {
        $flash_sale = FlashSale::findOrFail($id);
        $products = Product::all(); // Ambil semua produk untuk pilihan
        return view('pages.admin.flash_sales.edit', compact('flash_sale', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_price' => 'required|numeric',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $flash_sale = FlashSale::findOrFail($id);
        $flash_sale->update($request->all());

        Alert::success('Berhasil!', 'Flash Sale berhasil diperbarui.');
        return redirect()->route('admin.flash_sales');
    }


    // Menghapus flash sale
    public function delete($id)
    {

        $flashSale = FlashSale::findOrFail($id);

        if ($flashSale) {
            // Menghapus distributor dari database
            $flashSale->delete();
            // Pesan sukses jika data berhasil dihapus
            Alert::success('Berhasil!', 'Flash Sale berhasil dihapus!');
            return redirect()->route('admin.flash_sales');
        } else {
            // Pesan error jika gagal menghapus
            Alert::error('Gagal!', 'Flash Sale gagal dihapus!');
            return redirect()->back();
        }
    }
    
}
