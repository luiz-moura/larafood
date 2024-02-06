<?php

namespace Domains\Tenants\DataTransferObjects;

use DateTime;
use Domains\Plans\DataTransferObjects\PlanData;
use Domains\Tenants\Enums\TenantActiveEnum;
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
    public ?PlanData $plan;

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            uuid: $data['uuid'],
            plan_id: $data['plan_id'],
            cnpj: $data['cnpj'],
            name: $data['name'],
            email: $data['email'],
            url: $data['url'],
            logo: $data['logo'] ?? null,
            subscription_id: $data['subscription_id'] ?? null,
            active: TenantActiveEnum::from($data['active']),
            subscription_active: $data['subscription_active'],
            subscription_suspended: $data['subscription_suspended'],
            subscribed_at: new DateTime($data['subscribed_at']),
            expires_at: isset($data['expires_at']) ? new DateTime($data['expires_at']) : null,
            created_at: date_create($data['created_at']),
            updated_at: $data['updated_at'] ? date_create($data['updated_at']) : null,
            plan: isset($data['plan']) ? PlanData::fromArray($data['plan']) : null,
        );
    }
}
