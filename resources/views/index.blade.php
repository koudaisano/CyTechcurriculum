@extends('layouts.app')
@section('title', '商品一覧画面')

@push('styles')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endpush

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@push('scripts')
<script src="{{ asset('js/searchproduct.js') }}"></script>
@endpush

@section('content')
    <h1>商品一覧画面</h1>
    <form id="search-erea" method="GET" action = "{{ route('products.index')}}">
        <div class = "search-erea">
            <input class = "input-erea" type = "text" name = "product_name" placeholder = "検索キーワード">
                    <select class = "input-erea" name = "company_id">
                        <option value = "">メーカー名</option>
                            @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                            @endforeach
                    </select>
                <!-- 価格の範囲検索 -->
                <input class = "input-erea" type="number" name="min_price" placeholder="下限価格" value="{{ request('min_price') }}">
                <input class = "input-erea" type="number" name="max_price" placeholder="上限価格" value="{{ request('max_price') }}">
                <!-- 在庫数の範囲検索 -->
                <input class = "input-erea" type="number" name="min_stock" placeholder="最小在庫数" value="{{ request('min_stock') }}">
                <input class = "input-erea" type="number" name="max_stock" placeholder="最大在庫数" value="{{ request('max_stock') }}">
            <button type = "submit" class="search-button">検索</button>
        </div>
    </form>

<div id="product-list"> <!-- 検索結果をここに表示 -->
    <table id="product-table" class="tablesorter">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th><button onclick="window.location.href='{{ route('products.create') }}'" class="btn-newregistration" onclick="">新規登録</button></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr id= "product-row-{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>¥{{ number_format($product->price) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td>
                        <button onclick="window.location.href='{{ route('products.show', $product->id) }}'" class="btn-info" data-id="{{ $product->id }}">詳細</button>
                        <form action="{{ route('products.destroy', $product->id) }}" method="DELETE" data-product-id="{{ $product->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete" data-id="{{ $product->id }}">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <div class="pagination-container" id="pagination">
        {{ $products->links() }}
    </div>
@endsection

