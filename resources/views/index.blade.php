<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧画面</title>

    @extends('layouts.app')
    @section('styles')
        <link rel= "stylesheet" href= "{{ asset('/css/style.css') }}">
    @endsection

    @section('scripts')
        <script src="{{ asset('js/products.js') }}"></script>
    @endsection
</head>

<body>
    <h1>商品一覧画面</h1>
    <input type = "text" proceholder = "検索キーワード">
    <select>

        <option value = "">メーカー名</option>
        @foreach ($results as $result)
            <option>{{ $result->Company_name }}</option>
        @endforeach

    </select>
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
    </table>
    <table>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->id }}</td>
                    <td><img src="{{ asset('images/' . $result->image) }}" alt="商品画像"></td>
                    <td>{{ $result->product_name }}</td>
                    <td>{{ $result->name }}</td>
                    <td>¥{{ number_format($result->price) }}</td>
                    <td>{{ $result->stock }}</td>
                    <td>{{ $result->company_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
