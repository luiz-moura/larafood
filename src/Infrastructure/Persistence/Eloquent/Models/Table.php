<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Infrastructure\Persistence\Eloquent\Scopes\TenantScope;

class Table extends Model
{
    use HasFactory;

    protected $table = 'tables';
    protected $fillable = ['tenant_id', 'identify', 'description'];

    public function scopeTenantUser(Builder $query): Builder
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope());
    }
}