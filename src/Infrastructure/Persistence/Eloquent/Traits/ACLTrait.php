<?php

namespace Infrastructure\Persistence\Eloquent\Traits;

trait ACLTrait
{
    private $permissionsNames;

    public function hasPermission(string $permission): bool
    {
        return in_array(mb_strtolower($permission), $this->permissions(), true);
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    private function permissions(): array
    {
        if (!$this->permissionsNames) {
            $this->permissionsNames = $this->tenant->plan->profiles
                ->pluck('permissions')
                ->flatten()
                ->pluck('name')
                ->map(fn ($name) => mb_strtolower($name))
                ->unique()
                ->toArray();
        }

        return $this->permissionsNames;
    }
}
