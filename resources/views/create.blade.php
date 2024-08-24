@extends('layouts.app')

@section('content')
<h2>商品新規登録画面</h2>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">商品名 *</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="company_id">メーカー名 *</label>
        <select name="company_id" class="form-control" id="company_id" required>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="price">価格 *</label>
        <input type="number" id="price" name="price" required>
    </div>
    <div>
        <label for="stock">在庫数 *</label>
        <input type="number" id="stock" name="stock" required>
    </div>
    <div>
        <label for="comment">コメント</label>
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <label for="product_image">商品画像</label>
        <input type="file" id="product_image" name="img_path">
    </div>
    <div>
        <button type="submit">新規登録</button>
        @if ($errors->has('product_name'))
    <div class="alert alert-danger">
        {{ $errors->first('product_name') }}
    </div>
        @endif
        <button type="button" onclick="window.location.href = '/products';">戻る</button>
    </div>
</form>
@endsection
