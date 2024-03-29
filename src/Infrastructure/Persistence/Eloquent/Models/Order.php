<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Domains\Orders\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Infrastructure\Persistence\Eloquent\Scopes\TenantScope;
use Infrastructure\Persistence\Eloquent\Traits\LogTrait;

class Order extends Model
{
    use HasFactory;
    use LogTrait;

    protected $fillable = [
        'tenant_id',
        'identify',
        'client_id',
        'table_id',
        'total',
        'status',
        'comment',
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'price']);
    }

    public function evaluations(): BelongsTo
    {
        return $this->belongsTo(OrderEvaluation::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope());
    }
}
