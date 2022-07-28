<?php

namespace Application\Observers;

use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\Plans;

class PlansObserver
{
    public function creating(Plans $plan)
    {
        $plan->name = ucfirst($plan->name);
        $plan->url = Str::kebab($plan->name);
    }

    public function updating(Plans $plan)
    {
        $plan->name = ucfirst($plan->name);
        $plan->url = Str::kebab($plan->name);
    }
}
