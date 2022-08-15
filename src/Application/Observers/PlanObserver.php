<?php

namespace Application\Observers;

use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\Plan;

class PlanObserver
{
    public function creating(Plan $plan)
    {
        $plan->name = ucfirst($plan->name);
        $plan->url = Str::kebab($plan->name);
    }

    public function updating(Plan $plan)
    {
        $plan->name = ucfirst($plan->name);
        $plan->url = Str::kebab($plan->name);
    }
}
