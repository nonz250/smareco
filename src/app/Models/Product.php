<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $table = 'products';
    protected $fillable = [
        'id',
        'provider_id',
        'contract_id',
        'product_id',
        'category_id',
        'code',
        'name',
        'kana',
        'tax_division',
        'price',
        'customer_price',
        'cost',
        'description',
    ];
}
