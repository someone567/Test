@extends('layouts.app')

@section('content')

<!-- CSSは下にある方が優先されるのでここに読み込むように記載している
-->
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品登録</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('submit') }}" method="post">
                    @csrf
                    
                    <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}">
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
                    </div>

                    <!-- 会社名についてはまだDB作成していないのでDB対応次第セレクトボックスと連携
                    -->
                    <div class="form-group">
                    <label for="company_name">会社名</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
                    @if($errors->has('company_name'))
                        <p>{{ $errors->first('company_name') }}</p>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="price">価格</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="stock">在庫数</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                    @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control" id="comment" name="comment">
                    {{ old('comment') }}
                    </textarea>
                    @if($errors->has('comment'))
                        <p>{{ $errors->first('comment') }}</p>
                    @endif
                    </div>

                    <!-- ボタンのCSSがおかしいので後で直す見込み、動作確認目的でテキストに変更中
                    -->
                    <div class="form-group2">
                    <label for="img_path">商品画像</label>
                    <input type="text" class="form-control" id="img_path" name="img_path">
                    </div>

                    <button type="submit" class="btn btn-default">登録</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
