@extends('layouts.app')
@section('title', '商品一覧画面')

@push('styles')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endpush
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <h1>商品一覧画面</h1>
        <div class = "search-erea">
            <input type = "text" placeholder = "検索キーワード">
                    <select>
                        <option value = "">メーカー名</option>
                            @foreach ($companies as $company)
                        <option>{{ $company->company_name }}</option>
                            @endforeach
                    </select>
                <button class="search-button">検索</button>
        </div>

    <table>
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
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset('images/' . $product->image) }}" alt="商品画像"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>¥{{ number_format($product->price) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td>
                        <button onclick="window.location.href='{{ route('products.show', $product->id) }}'" class="btn-info">詳細</button>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $products->links() }}
    </div>
@endsection
