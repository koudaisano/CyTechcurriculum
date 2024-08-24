@extends('layouts.app')

@section('content')

@section('head')
       <link rel="stylesheet" href="{{ asset('css/show.style.css') }}">
@endsection

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<h2>商品情報詳細画面</h2>
<div class="container">
    <label>ID {{ $product->id }}</label>
    <label>商品画像<img src="{{ asset('images/' . $product->image) }}" alt="商品画像"></label>
    <label>価格 ¥{{ number_format($product->price) }}</label>
    <label>在庫 {{ $product->stock }}</label>
    <label>メーカー {{ $product->company->company_name }}</label>
</div>
<button type ="button" onclick="window.location.href = '/products';">戻る</button>
<button type="button" onclick="window.location.href = '{{ route('products.edit', $product->id) }}';">編集</button>
@endsection
