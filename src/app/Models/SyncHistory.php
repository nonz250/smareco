<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncHistory extends Model
{
    public $incrementing = false;
    protected $table = 'sync_histories';
    protected $fillable = [
        'id',
        'provider_id',
        'contract_id',
        'target',
        'sync_datetime',
    ];
}
