<?php

namespace Infrastructure\Persistence\Eloquent\Traits;

trait ACLTrait
{
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
        return array_intersect($this->rolePermissions(), $this->planPermissions());
    }

    private function rolePermissions(): array
    {
        return $this->roles
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->map(fn ($name) => mb_strtolower($name))
            ->unique()
            ->toArray();
    }

    private function planPermissions()
    {
        return $this->tenant->plan->profiles
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->map(fn ($name) => mb_strtolower($name))
            ->unique()
            ->toArray();
    }
}
