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
    public function list(Request $request)
    {
        $productName = $request->input('product_name');
        $companyId = $request->input('company_id');

        $model = new Product();
        $products = $model->getList($productName, $companyId);

        foreach ($products as $product) {
            $product->img_path = str_replace('public', 'storage', $product->img_path);
        }

        $companyModel = new Company();
        $companies = $companyModel->getAll();

        return view('plist', compact('products', 'companies'));
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
        $companies = $model->getAll();
        return view('pregister', ['companies' => $companies]);
    }

    public function registSubmit(ProductRequest $request)
    {
        $input = $request->all();
        // トランザクション開始
        DB::beginTransaction();

        try {

            $input['img_path'] = $input['img_path']->store('public/images');

            // 登録処理呼び出し
            $model = new Product();
            $model->registProduct($input);

            DB::commit();
        } catch (\Exception $e) {
            // phpMYadminでcommentをnull許容に変更必要
            DB::rollback();
            return back();
        }

        // 処理が完了したらp.registerにリダイレクト
        return redirect(route('pregister'));
    }

    public function store(Request $request)
    {
        $file = $request->img_path;
        // 画像情報がセットされていれば、保存処理を実行
        if (isset($file)) {
            // storage > app > public > images配下に画像が保存される
            $path = $file->store('public/images');
            // store処理が実行できたらDBに保存処理を実行
            if ($path) {
                // DBに登録する処理
                Product::create([
                    'img_path' => $path,
                ]);
            }
        }
    }

    public function create(Request $request)
    {
        return view('products.create');
    }

    /**
     * 詳細画面
     */
    public function show($id)
    {
        $model = new Product();
        $products = $model->getDetail($id);
        return view('detail', compact('products'));
    }

    /**
     * 編集画面
     */
    public function edit($id)
    {
        $model = new Product();
        $products = $model->getEdit($id);
        $companies = Company::all();
        return view('edit', compact('products', 'companies'));
    }
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $products->product_name = $request->input('product_name');
        $products->price = $request->input('price');
        $products->stock = $request->input('stock');
        $products->comment = $request->input('comment');
        $products->img_path = $request->input('img_path');
        $products->company_id = $request->input('company_id');
        $products->save();

        return redirect()->route('edit', $products->id);
    }

}