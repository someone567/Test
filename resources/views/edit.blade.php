@extends('layouts.app')

@section('content')

<!-- CSSは下にある方が優先されるのでここに読み込むように記載している
-->
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品情報編集</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('update', $products->id) }}">
                    @csrf


                        <div class="form-group">
                        <label for="product_name">商品名</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $products->product_name }}">
                    @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif
                        </div>

                        <div class="form-group">
                    <label for="company_id">会社名</label>
                    <select name="company_id">
                    @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                    </select>
                    @if($errors->has('company_name'))
                        <p>{{ $errors->first('company_name') }}</p>
                    @endif
                    </div>


                        <div class="form-group">
                    <label for="price">価格</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $products->price }}">
                    @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="stock">在庫数</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $products->stock }}">
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

                    <div class="form-group2">
                    <label for="img_path">商品画像</label>
                    <input type="text" class="form-control" id="img_path" name="img_path" value="{{ $products->img_path }}">
                    </div>

                    <div>
                        <button type="submit">更新</button>
                    </div>

                    <a href="{{ route('plist') }}">戻る</a>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
