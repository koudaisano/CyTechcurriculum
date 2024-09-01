@extends('layouts.app')


@section('head')
@push('styles')
<link href="{{ asset('css/show-style.css') }}" rel="stylesheet">
@endpush
@endsection
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<h2>商品情報詳細画面</h2>
    <div class="show-container">
        <div class="show-group">
        <label>ID</label><span class = product_id>{{ $product->id }}</span>
        </div>

        <div class="show-group">
        <label>商品画像</label>
        <span class = product_img><img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像"></span>
        </div>

        <div class="show-group">
            <label>商品名</label><span class = product_name>{{ $product->product_name }}</span>
            </div>

        <div class="show-group">
            <label>メーカー</label><span class = product_company_name>{{ $product->company->company_name }}</span>
        </div>

        <div class="show-group">
        <label>価格</label><span class = product_price>¥{{ number_format($product->price) }}</span>
        </div>

        <div class="show-group">
        <label>在庫</label><span class = product_stock>{{ $product->stock }}</span>
        </div>



        <div class="show-group">
        <label>コメント</label><span class = product_comment>{{ $product->comment }}<span>
        </div>

        <label class="show-group">
            <button class = "btn-back" type ="button" onclick="window.location.href = '/products';">戻る</button>
            <button class = "btn-edit" type="button" onclick="window.location.href = '{{ route('products.edit', $product->id) }}';">編集</button>
        </label>
    </div>
@endsection
