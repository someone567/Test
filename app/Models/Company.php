<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Company extends Model
{
    protected $table = "companies";

    public function getList()
    {
        // companiesテーブルからデータを取得
        //
        $companies = DB::table($this->table)->leftJoin('products', 'companies.id', '=', 'products.company_id')->get();
        return $companies;
    }

    public function getAll()
    {
        // companies全件取得
        //
        $companies = DB::table($this->table)->get();
        return $companies;
    }


}