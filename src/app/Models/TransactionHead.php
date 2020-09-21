<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHead extends Model
{
    protected $table = 'transaction_heads';
    protected $fillable = [
        'id',
        'provider_id',
        'contract_id',
        'transaction_head_id',
        'transaction_datetime',
        'cancel_division',
        'total',
        'point_discount',
        'amount',
        'store_id',
        'customer_id',
        'customer_code',
    ];
    public $incrementing = false;
}
