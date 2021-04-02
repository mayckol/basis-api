<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 * @package App\Models
 */
class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'task_type_id',
        'status',
        'obs',
    ];

    public function taskType(): BelongsTo
    {
        return $this->belongsTo(TaskType::class);
    }
}
