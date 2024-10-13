<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FlashSale;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        return view('pages.admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('pages.admin.product.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Jika ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        // Buat produk baru
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'image' => $imageName ?? null, // Simpan nama file gambar
        ]);

        // Cek apakah produk berhasil ditambahkan
        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
            return redirect()->route('admin.product.index');
        } else {
            Alert::error('Gagal!', 'Produk gagal ditambahkan!');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'numeric',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Jika ada file gambar yang diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldPath = public_path('images/' . $product->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        // Update data produk
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
        ]);

        Alert::success('Berhasil!', 'Produk berhasil diperbarui!');
        return redirect()->route('admin.product.index');
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.admin.product.detail', compact('product'));
    
    }
    

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.admin.product.edit', compact('product'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar jika ada
        $oldPath = public_path('images/' . $product->image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        // Hapus produk
        $product->delete();

        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil dihapus!');
        } else {
            Alert::error('Gagal!', 'Produk gagal dihapus!');
        }

        return redirect()->back();
    }

    public function indexInAdmin()
    {
        $products = Product::all();
        return view('pages.admin.index', compact('products'));
    }
}
