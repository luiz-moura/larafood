<?php

namespace Domains\Tenants\DataTransferObjects;

use DateTime;
use Domains\Plans\DataTransferObjects\PlanData;
use Domains\Tenants\Enums\TenantActiveEnum;
use Infrastructure\Persistence\Eloquent\Models\Tenant;
use Infrastructure\Shared\DataTransferObject;

class TenantData extends DataTransferObject
{
    public int $id;
    public string $uuid;
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
    public ?DateTime $expires_at;
    public DateTime $created_at;
    public ?DateTime $updated_at;
    public PlanData $plan;

    public static function fromModel(Tenant $tenant): self
    {
        return new self([
            'active' => $tenant->active,
            'subscribed_at' => $tenant->subscribed_at,
            'expires_at' => $tenant->expires_at,
            'created_at' => $tenant->created_at,
            'updated_at' => $tenant->updated_at,
            'plan' => PlanData::fromModel($tenant->plan),
        ] + $tenant->toArray());
    }

    public static function fromArray(array $data): self
    {
        return new self([
            'active' => TenantActiveEnum::from($data['active']),
            'subscribed_at' => new DateTime($data['subscribed_at']),
            'created_at' => new DateTime($data['created_at']),
            'updated_at' => isset($data['updated_at']) ? new DateTime($data['updated_at']) : null,
            'expires_at' => isset($data['expires_at']) ? new DateTime($data['expires_at']) : null,
            'plan' => isset($data['plan']) ? PlanData::fromArray($data['plan']) : null,
        ] + $data);
    }
}
