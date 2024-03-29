<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Domains\Tenants\Enums\TenantActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Infrastructure\Persistence\Eloquent\Traits\LogTrait;

class Tenant extends Model
{
    use HasFactory;
    use LogTrait;

    protected $table = 'tenants';

    protected $fillable = [
        'cnpj',
        'name',
        'email',
        'url',
        'logo',
        'plan_id',
        'subscription_id',
        'active',
        'subscription_active',
        'subscription_suspended',
        'subscribed_at',
        'expires_at',
    ];

    protected $casts = [
        'active' => TenantActiveEnum::class,
        'subscribed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    protected $attributes = [
        'active' => TenantActiveEnum::ACTIVE,
        'subscription_active' => true,
        'subscription_suspended' => false,
        'subscribed_at' => 'now',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
