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
        $model = new Product();

        // フォームからの入力を取得
        $productName = $request->input('product_name');
        $companyId = $request->input('company_id');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $minStock = $request->input('min_stock');
        $maxStock = $request->input('max_stock');

        // 検索条件を配列にまとめる
        $conditions = [
            'product_name' => $productName,
            'company_id' => $companyId,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'min_stock' => $minStock,
            'max_stock' => $maxStock,
        ];

        // 検索結果を取得
        $products = $model->getList($conditions);

        // メーカー一覧を取得
        $companies = (new Company())->getAll();


        return view('plist', compact('products', 'companies'));
    }


    /**
     * 削除ボタンの動作
     */
    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();

        return redirect()->route('plist'); // jsの.readyと.click削除の場合、この行削除すると選択したIDにリダイレクト
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