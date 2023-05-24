<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Infrastructure\Persistence\Eloquent\Traits\LogTrait;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use LogTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
        'expires_at',
        'email_verified_at',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function evaluations(): BelongsTo
    {
        return $this->belongsTo(OrderEvaluation::class);
    }
}
