@extends('layouts.admin.main') 
@section('title', 'Admin Product') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Produk</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Produk</div> 
            </div> 
        </div> 
        <a href="#" class="btn btn-icon icon-left btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah Produk
        </a> 

        <div class="row">
            @foreach($products as $prod)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/product/' . $prod->image) }}" class="card-img-top" alt="{{ $prod->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $prod->name }}</h5>
                            <p class="card-text">{{ $prod->price }} Points</p>
                            <p class="card-text">Stok: {{ $prod->stock }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-info btn-sm">Detail</a>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            @if($products->isEmpty())
                <div class="col-12 text-center">
                    <p>Data Produk Kosong</p>
                </div>
            @endif
        </div>
    </section> 
</div> 
@endsection
