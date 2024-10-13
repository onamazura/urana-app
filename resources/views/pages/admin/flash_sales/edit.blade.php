@extends('layouts.admin.main')
@section('title', 'Edit Flash Sale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Flash Sale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.flash_sales') }}">Flash Sales</a></div>
                <div class="breadcrumb-item">Edit Flash Sale</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Form untuk edit flash sale -->
                <form action="{{ route('admin.flash_sales.update', $flash_sale->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Pilihan Produk -->
                    <div class="form-group">
                        <label for="product_id">Produk</label>
                        <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
                            <option value="" disabled>Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $flash_sale->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga Diskon -->
                    <div class="form-group">
                        <label for="discount_price">Harga Diskon</label>
                        <input type="text" name="discount_price" id="discount_price" class="form-control @error('discount_price') is-invalid @enderror" value="{{ old('discount_price', $flash_sale->discount_price) }}">
                        @error('discount_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Waktu Mulai -->
                    <div class="form-group">
                        <label for="start_time">Waktu Mulai</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', date('Y-m-d\TH:i', strtotime($flash_sale->start_time))) }}">
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Waktu Berakhir -->
                    <div class="form-group">
                        <label for="end_time">Waktu Berakhir</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', date('Y-m-d\TH:i', strtotime($flash_sale->end_time))) }}">
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol submit -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.flash_sales') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
