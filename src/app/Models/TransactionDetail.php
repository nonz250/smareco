<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $fillable = [
        'transaction_head_id',
        'provider_transaction_head_id',
        'product_id',
        'product_code',
        'product_name',
        'price',
        'quantity',
    ];
}
