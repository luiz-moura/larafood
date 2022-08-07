<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanDetails extends Model
{
    use HasFactory;

    protected $table = 'plan_details';
    protected $fillable = ['plan_id', 'name'];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plans::class, 'plan_id', 'id');
    }
}