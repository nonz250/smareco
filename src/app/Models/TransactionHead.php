<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionHead extends Model
{
    public $incrementing = false;
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

    public function transaction_detail(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_head_id', 'id');
    }
}
