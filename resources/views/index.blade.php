<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧画面</title>

    @section('styles')
        <link rel= "stylessheet" href= "{{ asset('/css/style.css') }}">
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
@foreach ($companies as $companie)
            <option>{{ $companies->company_name }}</option>
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
        @foreach ( $products as $product )
        <tr>
            <td>{{$product->id}}</td>
            <td><img src="{{ asset('images/'.$product->image)}}" alt="商品画像"></td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->name}}</td>
            <td>¥{{number_format($product->price)}}</td>
            <td>{{ $product->stock }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
