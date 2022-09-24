<?php

namespace Domains\Tenants\DataTransferObjects;

use DateTime;
use Domains\Tenants\Enums\TenantActiveEnum;
use Infrastructure\Persistence\Eloquent\Models\Tenant;
use Infrastructure\Shared\DataTransferObject;

class TenantData extends DataTransferObject
{
    public int $id;
    public int $plan_id;
    public string $cnpj;
    public string $name;
    public string $email;
    public string $url;
    public ?string $logo;
    public ?string $subscription_id;
    public TenantActiveEnum $active;
    public bool $subscription_active;
    public bool $subscription_suspended;
    public DateTime $subscribed_at;
    public DateTime $expires_at;
    public DateTime $created_at;
    public ?DateTime $updated_at;

    public static function fromModel(Tenant $tenant): self
    {
        return new self([
            'active' => $tenant->active,
            'subscribed_at' => $tenant->subscribed_at,
            'expires_at' => $tenant->expires_at,
            'created_at' => $tenant->created_at,
            'updated_at' => $tenant->updated_at,
        ] + $tenant->toArray());
    }

    public static function fromArray(array $data): self
    {
        return new self([
            'active' => TenantActiveEnum::from($data['active']),
            'subscribed_at' => new DateTime($data['subscribed_at']),
            'created_at' => new DateTime($data['created_at']),
            'expires_at' => $data['expires_at'] ? new DateTime($data['expires_at']) : null,
            'updated_at' => $data['updated_at'] ? new DateTime($data['updated_at']) : null,
        ] + $data);
    }
}
