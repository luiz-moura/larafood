<?php

namespace Application\Observers;

use Infrastructure\Persistence\Eloquent\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->name = ucfirst($user->name);
    }

    public function updating(User $user)
    {
        $user->name = ucfirst($user->name);
    }
}
