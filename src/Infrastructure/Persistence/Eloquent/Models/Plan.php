<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Infrastructure\Persistence\Eloquent\Traits\LogTrait;

class Plan extends Model
{
    use HasFactory;
    use LogTrait;

    protected $table = 'plans';
    protected $fillable = ['name', 'url', 'price', 'description'];

    public function details(): HasMany
    {
        return $this->hasMany(PlanDetail::class);
    }

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }
}
