<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function CompanyNameById($Id)
    {
        return DB::table('products')
        ->join('companies', 'Products.company_id', '=', 'companies.id')
        ->where('products.id' , $Id)
        ->select('companies.company_name')
        ->first();
    }
}
