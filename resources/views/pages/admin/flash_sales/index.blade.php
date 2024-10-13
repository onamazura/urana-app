@extends('layouts.admin.main')
@section('title', 'Admin Flash Sale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>

        <!-- Tombol Tambah Flash Sale -->
        <a href="{{ route('admin.flash_sales.create') }}" class="btn btn-icon icon-left btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah Flash Sale
        </a>

        <!-- <pre>
    {{ print_r($flash_sales) }}
</pre> -->

        <!-- Flash Sale Aktif -->
        <div class="card">
            <div class="card-header">
                <h4>Flash Sale Aktif</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga Diskon</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Berakhir</th>
                                <th>Action</th> <!-- Kolom Action untuk CRUD -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($flash_sales as $flash_sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $flash_sale->product->name }}</td> <!-- Mengambil nama produk dari relasi -->
                                    <td>{{ $flash_sale->discount_price }}</td>
                                    <td>{{ $flash_sale->start_time }}</td>
                                    <td>{{ $flash_sale->end_time }}</td>
                                    <td>
                                        <a href="{{ route('admin.flash_sales.edit', $flash_sale->id) }}" class="badge badge-warning">Edit</a>
                                        <form action="{{ route('admin.flash_sales.delete', $flash_sale->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-danger" data-confirm-delete="true">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada flash sale yang aktif saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Semua Flash Sale -->
        <div class="card">
            <div class="card-header">
                <h4>Semua Flash Sale</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga Diskon</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Berakhir</th>
                                <th>Action</th> <!-- Kolom Action untuk CRUD -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Dflashsales as $flash_sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $flash_sale->product->name }}</td> <!-- Mengambil nama produk dari relasi -->
                                    <td>{{ $flash_sale->discount_price }}</td>
                                    <td>{{ $flash_sale->start_time }}</td>
                                    <td>{{ $flash_sale->end_time }}</td>
                                    <td>
                                        
                                        <a href="{{ route('admin.flash_sales.edit', $flash_sale->id) }}" class="badge badge-warning">Edit</a>
                                        
                                        <form action="{{ route('admin.flash_sales.delete', $flash_sale->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-danger" data-confirm-delete="true">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada flash sale yang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
