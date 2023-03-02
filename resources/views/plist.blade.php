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
                <div class="links">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫</th>
            <th>メーカー</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->img_path }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company_name }}</td>
            <td><a href="{{ route('detail', ['id' => $product->id]) }}"><button type="button" class="btn btn-detail">詳細</button></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
            </div>
        </div>
    </div>
</div>

@endsection