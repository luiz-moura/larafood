<?php

namespace Application\Observers;

use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\Tenant;

class TenantObserver
{
    public function creating(Tenant $tenant)
    {
        $tenant->name = ucfirst($tenant->name);
        $tenant->url = Str::kebab($tenant->name);
        $tenant->uuid = Str::uuid()->toString();
    }

    public function updating(Tenant $tenant)
    {
        $tenant->name = ucfirst($tenant->name);
        $tenant->url = Str::kebab($tenant->name);
    }
}
