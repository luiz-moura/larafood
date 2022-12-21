<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Infrastructure\Persistence\Eloquent\Traits\LogTrait;

class PlanDetail extends Model
{
    use HasFactory;
    use LogTrait;

    protected $table = 'plan_details';
    protected $fillable = ['plan_id', 'name'];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
