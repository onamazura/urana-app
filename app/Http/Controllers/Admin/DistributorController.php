<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distributor;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        return view('pages.admin.distributors.index', compact('distributors'));
    }

    public function create()
    {
        return view('pages.admin.distributors.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'nama_distributor' => 'required|string|max:255', // Diperbaiki dari 'nama_distibutor'
            'lokasi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            // Menampilkan pesan error jika validasi gagal
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menambahkan distributor ke database
        $distributor = Distributor::create([
            'nama_distributor' => $request->nama_distributor, // Diperbaiki dari 'nama_distibutor'
            'lokasi' => $request->lokasi,
            'kontak' => $request->kontak,
            'email' => $request->email,
        ]);

        if ($distributor) {
            // Pesan sukses jika data berhasil ditambahkan
            Alert::success('Berhasil!', 'Distributor berhasil ditambahkan!');
            return redirect()->route('admin.distributors');
        } else {
            // Pesan error jika gagal menyimpan data
            Alert::error('Gagal!', 'Distributor gagal ditambahkan!');
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        $distributor = Distributor::findOrFail($id); // Mengambil distributor berdasarkan ID
        
        return view('pages.admin.distributors.detail', compact('distributor'));
    }

    public function edit($id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('pages.admin.distributors.edit', compact('distributor'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->method());
        
        // Validasi input dari form update
        $validator = Validator::make($request->all(), [
            'nama_distributor' => 'required|string|max:255', // Diperbaiki dari 'nama_distibutor'
            'lokasi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            // Menampilkan pesan error jika validasi gagal
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mengupdate distributor yang sudah ada
        $distributor = Distributor::findOrFail($id);
        $distributor->update($request->all());

        // Pesan sukses jika update berhasil
        Alert::success('Berhasil!', 'Distributor berhasil diperbarui!');
        return redirect()->route('admin.distributors');
    }

    public function delete($id)
    {
        $distributor = Distributor::findOrFail($id);

        if ($distributor) {
            // Menghapus distributor dari database
            $distributor->delete();
            // Pesan sukses jika data berhasil dihapus
            Alert::success('Berhasil!', 'Distributor berhasil dihapus!');
            return redirect()->route('admin.distributor');
        } else {
            // Pesan error jika gagal menghapus
            Alert::error('Gagal!', 'Distributor gagal dihapus!');
            return redirect()->back();
        }
    }
}
