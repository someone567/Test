<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList($conditions)
    {
        $query = $this->query();

        // 商品名の検索
        if ($conditions['product_name']) {
            $query->where('product_name', 'LIKE', '%' . $conditions['product_name'] . '%');
        }

        // メーカーの検索
        if ($conditions['company_id']) {
            $query->where('company_id', $conditions['company_id']);
        }

        // 価格の範囲検索
        if ($conditions['min_price']) {
            $query->where('price', '>=', $conditions['min_price']);
        }
        if ($conditions['max_price']) {
            $query->where('price', '<=', $conditions['max_price']);
        }

        // 在庫数の範囲検索
        if ($conditions['min_stock']) {
            $query->where('stock', '>=', $conditions['min_stock']);
        }
        if ($conditions['max_stock']) {
            $query->where('stock', '<=', $conditions['max_stock']);
        }

        return $query->leftJoin('companies', 'products.company_id', '=', 'companies.id') // メーカー情報を結合
            ->select('products.*', 'companies.company_name') // 必要なカラムを選択
            ->get();
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