@extends('layouts.admin.main') 
@section('title', 'Admin  Distributors')
@section('content')
<div class="main-content">
    <section class="section">
    <div class="section-header"> 
            <h1>Dashboard</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div> 
            </div> 
        </div> 

        <a href="{{ route('distributors.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Distributor
        </a>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>#</th>
                        <th>Nama Distributor</th>
                        <th>Lokasi</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($distributors as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_distributor }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{route('distributors.edit', $item->id) }}" class="badge badge-warning">Edit</a>
                                <a href="{{ route('distributors.delete', $item->id) }}" class="badge badge-danger" 
                                data-confirm-delete="true">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Data Produk Kosong</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </section>
</div>
@endsection