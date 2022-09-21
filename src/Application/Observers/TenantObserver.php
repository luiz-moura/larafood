<?php

namespace Application\Observers;

use DateTime;
use Domains\Tenants\Enums\TenantsActiveEnum;
use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\Tenant;

class TenantObserver
{
    public function creating(Tenant $tenant)
    {
        $tenant->name = ucfirst($tenant->name);
        $tenant->url = Str::kebab($tenant->name);
        $tenant->uuid = Str::uuid();
        $tenant->active ??= TenantsActiveEnum::ACTIVE;
        $tenant->subscription_active ??= true;
        $tenant->subscription_suspended ??= false;
        $tenant->subscribed_at ??= new DateTime();
        $tenant->expires_at ??= new DateTime('now + 7 day');
    }

    public function updating(Tenant $tenant)
    {
        $tenant->name = ucfirst($tenant->name);
        $tenant->url = Str::kebab($tenant->name);
        $tenant->active ??= TenantsActiveEnum::ACTIVE;
    }
}
