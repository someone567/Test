<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

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

    /**
     * 商品登録ボタン押した後の動作
     */
    public function showRegistForm()
    {
        return view('register');
    }

    public function registSubmit(ProductRequest $request)
    {

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 登録処理呼び出し
            $model = new Product();
            $model->registProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        // 処理が完了したらregisterにリダイレクト
        return redirect(route('register'));
    }

}