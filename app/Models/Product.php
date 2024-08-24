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

    public function company()
    {
        return $this->belongsTo(Companie::class, 'company_id');
    }

    protected $fillable = [
        'name',
        'price',
        'company_id',
        'stock',
        'comment',
        'img_path',
        // 他に保存したい属性があればここに追加します
    ];
}
