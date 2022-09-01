<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Domains\Tenants\Enums\TenantsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;

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

    protected $dates = [
        'subscribed_at',
        'expires_at',
    ];

    protected $casts = [
        'active' => TenantsActiveEnum::class,
        'subscribed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }
}
