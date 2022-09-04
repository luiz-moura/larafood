<?php

namespace Application\Observers;

use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\User;

class UserObeserver
{
    public function creating(User $user)
    {
        $user->name = ucfirst($user->name);
        $user->password = Hash::make($user->password);
    }

    public function updating(User $user)
    {
        $user->name = ucfirst($user->name);
        $user->password = Hash::make($user->password);
    }
}
