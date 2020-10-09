<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIProcessHistory extends Model
{
    public $incrementing = false;
    protected $table = 'ai_process_histories';
    protected $fillable = [
        'id',
        'contract_id',
        'status',
        'notification_datetime',
    ];
}
