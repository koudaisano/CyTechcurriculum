@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品情報編集画面</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" >

        </div>

        <div class="form-group">
            <label for="image">商品画像</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}" class="form-control">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock">在庫</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" class="form-control">
            @error('stock')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="company_name">メーカー</label>
            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $product->company->company_name) }}" class="form-control">
            @error('company_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
