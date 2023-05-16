<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getList($productName = null, $companyId = null)
    {
        $query = DB::table('products')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->select('companies.*', 'products.*');

        if ($productName) {
            $query->where('products.product_name', 'LIKE', '%' . $productName . '%');
        }

        if ($companyId) {
            $query->where('companies.id', $companyId);
        }
        return $query->get();
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