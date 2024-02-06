<?php

namespace Interfaces\Http\Tenant\DataTransferObjects;

use DateTime;
use Domains\Tenants\Enums\TenantActiveEnum;
use Infrastructure\Shared\DataTransferObject;

class TenantFormData extends DataTransferObject
{
    public string $name;
    public ?string $logo;
    public string $email;
    public string $cnpj;
    public ?string $image;
    public TenantActiveEnum $active;
    public DateTime $subscribed_at;
    public DateTime $expires_at;
    public string $subscription_id;
    public bool $subscription_active;
    public bool $subscription_suspended;

    public static function fromRequest(array $data): self
    {
        return new self([
            'subscribed_at' => new DateTime($data['subscribed_at']),
            'expires_at' => new DateTime($data['expires_at']),
            'active' => TenantActiveEnum::from($data['active']),
        ] + $data);
    }
}
