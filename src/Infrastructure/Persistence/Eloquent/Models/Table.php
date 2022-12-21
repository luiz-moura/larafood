<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Infrastructure\Persistence\Eloquent\Scopes\TenantScope;
use Infrastructure\Persistence\Eloquent\Traits\LogTrait;

class Table extends Model
{
    use HasFactory;
    use LogTrait;

    protected $table = 'tables';
    protected $fillable = ['tenant_id', 'identify', 'description'];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope());
    }
}
