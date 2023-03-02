@extends('layouts.app')

@section('content')

<!-- CSSは下にある方が優先されるのでここに読み込むように記載している
-->
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品情報詳細</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>商品ID</h3>
                    <p>{{ $products->id }}</p>
                    <h3>商品画像</h3>
                    <p>{{ $products->img_path }}</p>
                    <h3>商品名</h3>
                    <p>{{ $products->product_name }}</p>
                    <h3>メーカー</h3>
                    <p>{{ $products->company_name }}</p>
                    <h3>価格</h3>
                    <p>{{ $products->price }}</p>
                    <h3>在庫数</h3>
                    <p>{{ $products->stock }}</p>
                    <h3>コメント</h3>
                    <p>{{ $products->comment }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
