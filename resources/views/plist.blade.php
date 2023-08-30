@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/plist.css') }}">


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品情報一覧</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <a href="{{ route('pregister') }}">新規登録</a>
                </div>

                <!-- 検索フォーム -->
<form action="{{ route('plist') }}" method="GET">
    <div class="form-group">
        <label for="product_name">商品名:</label>
        <input type="text" id="product_name" name="product_name" class="form-control" value="{{ request()->input('product_name') }}">
    </div>
    <div class="form-group">
        <label for="company_id">メーカー:</label>
        <select id="company_id" name="company_id" class="form-control">
            <option value="">-- 選択してください --</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" {{ request()->input('company_id') == $company->id ? 'selected' : '' }}>
                    {{ $company->company_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="min_price">最低価格:</label>
        <input type="number" id="min_price" name="min_price" class="form-control" value="{{ request()->input('min_price') }}">
    </div>
    <div class="form-group">
        <label for="max_price">最高価格:</label>
        <input type="number" id="max_price" name="max_price" class="form-control" value="{{ request()->input('max_price') }}">
    </div>
    <div class="form-group">
        <label for="min_stock">最低在庫数:</label>
        <input type="number" id="min_stock" name="min_stock" class="form-control" value="{{ request()->input('min_stock') }}">
    </div>
    <div class="form-group">
        <label for="max_stock">最高在庫数:</label>
        <input type="number" id="max_stock" name="max_stock" class="form-control" value="{{ request()->input('max_stock') }}">
    </div>
    <button type="submit" class="btn btn-primary">検索</button>
</form>

    <div id="product-list" class="links">
        <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫</th>
                <th>メーカー</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
           
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset($product->img_path) }}" width="150" height="100"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company_name }}</td>
                    <td>
                        <a href="{{ route('detail', ['id' => $product->id]) }}">
                            <button type="button" class="btn btn-detail">詳細</button>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-delete-id="{{$product->id}}" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection