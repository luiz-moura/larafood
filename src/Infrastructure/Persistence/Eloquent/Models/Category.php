<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Infrastructure\Persistence\Eloquent\Scopes\TenantScope;
use Infrastructure\Persistence\Eloquent\Traits\LogTrait;

class Category extends Model
{
    use HasFactory;
    use LogTrait;

    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'url', 'tenant_id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
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
