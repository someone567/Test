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

                    @foreach ($products as $products)
                    
                    <h4>商品ID</h4>
                    <p>{{ $products->id }}</p>
                    <h4>商品画像</h4>
                    <p>{{ $products->img_path }}</p>
                    <h4>商品名</h4>
                    <p>{{ $products->product_name }}</p>
                    <h4>メーカー</h4>
                    <p>{{ $products->company_name }}</p>
                    <h4>価格</h4>
                    <p>{{ $products->price }}</p>
                    <h4>在庫数</h4>
                    <p>{{ $products->stock }}</p>
                    <h4>コメント</h4>
                    <p>{{ $products->comment }}</p>
                    @endforeach
                    <td><a href="{{ route('edit', ['id'=>$products->id]) }}" class="btn btn-info">編集</a></td>
                    <td><a href="{{ route('plist') }}">戻る</a></td>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
