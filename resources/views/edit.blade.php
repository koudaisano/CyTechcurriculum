@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/edit-style.css') }}" rel="stylesheet">
@endpush

@section('content')
<h2>商品情報編集画面</h2>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class = "label-container">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>商品名<span>*</span></label>
            <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $product->product_name) }}" class="form-control">
            @error('product_name')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>メーカー名<span>*</span></label>
            <select name="company_id" class="form-control" id="company_id" required>
                @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
            @error('company_id')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>価格<span>*</span></label>
            <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control">
            @error('price')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>在庫<span>*</span></label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="form-control">
            @error('stock')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>コメント</label>
            <input type="comment" name="comment" id="comment" value="{{ old('comment', $product->comment) }}" class="form-control">
        </div>

        <div class="form-group">
            <label>商品画像</label>
                <input type="file" name="img_path" id="image" class="form-control">
                @error('image')
                <div class="alert-danger">{{ $message }}</div>
                @enderror
        </div>

        <label>
        <button type="submit" class="btn-primary">更新</button>
        <button type = "button" onclick ="window.location.href = '/products';" class="btn-back">戻る</button>
        </label>
    </form>
    </div>
</div>
@endsection
