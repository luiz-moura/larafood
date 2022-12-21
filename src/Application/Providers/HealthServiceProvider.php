<?php

namespace Application\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\HorizonCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class HealthServiceProvider extends ServiceProvider
{
    public function register()
    {
        Health::checks([
            DatabaseCheck::new(),
            UsedDiskSpaceCheck::new(),
            CacheCheck::new(),
            HorizonCheck::new(),
            RedisCheck::new(),
            ScheduleCheck::new(),
        ]);
    }
}
