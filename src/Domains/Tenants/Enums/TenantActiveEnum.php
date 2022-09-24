<?php

namespace Domains\Tenants\Enums;

enum TenantActiveEnum: string
{
    case ACTIVE = 'Y';
    case INACTIVE = 'N';
}
