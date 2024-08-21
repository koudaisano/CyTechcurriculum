@extends('layouts.app')

@section('content')
<div class="container">
    <label>ID {{ $product->id }}</label>
    <label>商品画像<img src="{{ asset('images/' . $product->image) }}" alt="商品画像"></label>
    <label>価格 ¥{{ number_format($product->price) }}</label>
    <label>在庫 {{ $product->stock }}</label>
    <label>メーカー {{ $product->company->company_name }}</label>
</div>
<button type="button" onclick="window.location.href = '/products';">戻る</button>
<button>編集</button>
@endsection
