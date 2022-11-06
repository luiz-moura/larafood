<?php

namespace Application\Listeners;

use Application\Events\TenantCreated;
use Domains\ACL\Users\Actions\AttachRolesInUserAction;

class AddRoleTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private AttachRolesInUserAction $attachRolesInUserAction)
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        $roleId = (int) env('STANDARD_ROLE_ID');
        ($this->attachRolesInUserAction)($event->user->id, roles: [$roleId]);
    }
}
