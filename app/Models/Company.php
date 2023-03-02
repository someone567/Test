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
        $companies = DB::table($this->table)->get();

        return $companies;
    }
//
}