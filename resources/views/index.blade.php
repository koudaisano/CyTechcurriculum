@extends('layouts.app')
@section('title', '商品一覧画面')

@push('styles')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h1 class = index_title>商品一覧画面</h1>
    <input type = "text" proceholder = "検索キーワード">
    <select>

        <option value = "">メーカー名</option>
        @foreach ($results as $result)
            <option>{{ $result->Company_name }}</option>
        @endforeach

    </select>

    <button class="button">検索</button>
    <button class="button">新規登録</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td><img src="{{ asset('images/' . $result->image) }}" alt="商品画像"></td>
                    <td>{{ $result->product_name }}</td>
                    <td>¥{{ number_format($result->price) }}</td>
                    <td>{{ $result->stock }}</td>
                    <td>{{ $result->company_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
