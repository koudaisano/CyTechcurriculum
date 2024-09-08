@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/edit-style.css') }}" rel="stylesheet">
@endpush
@section('content')
<h2>商品新規登録画面</h2>
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">商品名<span>*</span></label>
        <input type="text" name="product_name" value="{{ old('product_name') }}">
        @error('product_name')
        <div class="alert alert-danger">{{ $message }}</div>
         @enderror
    </div>

    <div class="form-group">
        <label for="company_id">メーカー名<span>*</span></label>
        <select name="company_id" class="form-control" id="company_id" required>
            @foreach($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select>
            @error('company_id')
            <div class="alert alert-danger">{{ $message }}</div>
             @enderror
    </div>

    <div class="form-group">
        <label for="price">価格<span>*</span></label>
        <input type="number" id="price" name="price" value = "{{ old('price') }}" >
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="stock">在庫数<span>*</span></label>
        <input type="number" id="stock" name="stock"  value = "{{ old('price') }}" >
        @error('stock')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="comment">コメント</label>
        <textarea id="comment" name="comment"></textarea>
    </div>

    <div class="form-group">
        <label for="product_image">商品画像</label>
        <input type="file" id="product_image" name="img_path">
        @error('img_path')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit" class = "btn-newregistration">新規登録</button>
        <button class = "btn-back" type="button" onclick ="window.location.href = '/products';">戻る</button>
    </div>
</form>
@endsection
