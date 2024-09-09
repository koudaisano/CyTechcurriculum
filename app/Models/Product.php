<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price',
        'company_id',
        'stock',
        'comment',
        'img_path',
    ];

    public function company()
    {
        return $this->belongsTo(Companie::class, 'company_id');
    }

    public static function getCompanyNameById($Id)
    {
        return self::join('companies', 'Products.company_id', '=', 'companies.id')
        ->where('products.id' , $Id)
        ->select('companies.company_name')
        ->first();
    }
}
