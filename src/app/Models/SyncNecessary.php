<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncNecessary extends Model
{
    protected $table = 'sync_necessaries';
    protected $fillable = [
        'id',
        'provider_id',
        'contract_id',
        'target',
        'field',
    ];
}
