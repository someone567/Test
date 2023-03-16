<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
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
     * 削除ボタンの動作
     */
    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();

        return redirect()->route('plist');
    }

    /**
     * 商品登録ボタン押した後の動作
     */
    public function showRegistForm()
    {
        $model = new Company();
        $companies = $model->getList();

        return view('pregister', ['companies' => $companies]);
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
            dd($e);
            DB::rollback();
            return back();
        }

        // 処理が完了したらp.registerにリダイレクト
        return redirect(route('pregister'));
    }

    /**
     * 詳細画面
     */
    public function show($id)
    {
        $products = DB::table('products')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('companies.*', 'products.*')
            ->where('products.id', $id)
            ->get();

        return view('detail', compact('products'));
    }

    /**
     * 編集画面
     */
    public function edit($id)
    {
        $products = DB::table('products')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('companies.*', 'products.*')
            ->where('products.id', $id)
            ->first();

        return view('edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $products->product_name = $request->input('product_name');
        $products->company_name = $request->input('company_name');
        $products->price = $request->input('price');
        $products->stock = $request->input('stock');
        $products->comment = $request->input('comment');
        $products->img_path = $request->input('img_path');
        $products->save();

        return redirect()->route('edit', $products->id);
    }

}