<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList()
    {
        // productsテーブルからデータを取得
        $products = DB::table('products')->select('products.id', 'img_path', 'product_name', 'price', 'stock', 'company_name')
            ->leftjoin('companies', 'company_id', '=', 'companies.id')->get();
        return $products;
    }

    public function registProduct($data)
    {
        // 登録処理
        DB::table('products')->insert([
            'product_name' => $data['product_name'],
            'company_id' => $data['company_id'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'img_path' => $data['img_path'],
        ]);
    }

    protected $fillable = [
        'img_path',
    ];

    public function getDetail($id)
    {
        return DB::table('products')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('companies.*', 'products.*')
            ->where('products.id', $id)
            ->get();
    }

    public function getEdit($id)
    {
        return DB::table('products')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('companies.*', 'products.*')
            ->where('products.id', $id)
            ->first();
    }
}