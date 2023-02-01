<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧画面表示
     */
    public function list()
    {
                // インスタンス生成
                $model = new Product();
                $products = $model->getList();
        
                return view('plist', ['products' => $products]);
    }

    /**
     * 新規登録画面表示
     */
    public function register()
    {
        return view("register");
    }
}
