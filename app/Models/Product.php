<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList()
    {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();

        return $products;
    }

    public function registProduct($data)
    {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_name' => $data->company_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'img_path' => $data->img_path,
        ]);
    }

}