<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        // リクエストから商品IDを取得
        $productId = $request->input('product_id');

        // 商品の在庫数を取得
        $product = Product::find($productId);
        $stock = $product->stock;

        // 在庫が0以下の場合はエラーを返す
        if ($stock <= 0) {
            return response()->json(['error' => '在庫切れ'], 400);
        }

        // トランザクションを開始
        DB::beginTransaction();

        try {
            // Salesテーブルに購入レコードを追加
            Sale::create([
                'product_id' => $productId,
            ]);

            // 商品の在庫数を減らす
            $product->stock = $stock - 1;
            $product->save();

            DB::commit();

            return response()->json(['message' => '購入成功'], 200);
        } catch (\Exception $e) {
            // トランザクションをロールバック
            DB::rollBack();
            return response()->json(['error' => '購入エラー'], 500);
        }
    }
}