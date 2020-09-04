<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'id',
        'provider_id',
        'contract_id',
        'customer_id',
        'customer_code',
        'store_id',
        'rank',
        'name',
        'kana',
        'email',
        'sex',
        'mail_receive_flag',
        'status',
    ];
}
