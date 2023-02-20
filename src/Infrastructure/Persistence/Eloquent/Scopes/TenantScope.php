<?php

namespace Infrastructure\Persistence\Eloquent\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $tenant = auth()->user()?->tenant_id;

        if ($tenant) {
            $builder->where('tenant_id', $tenant);
        }
    }
}
