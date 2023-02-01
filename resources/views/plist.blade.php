@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <a href="{{ route('register') }}">新規登録</a>
                </div>
                <div class="links">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>img_path</th>
            <th>product_name</th>
            <th>price</th>
            <th>stock</th>
            <th>company_id</th>
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
            <td>{{ $product->company_id }}</td>
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