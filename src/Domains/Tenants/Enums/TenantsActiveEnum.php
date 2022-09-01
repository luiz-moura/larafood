<?php

namespace Domains\Tenants\Enums;

enum TenantsActiveEnum: string
{
    case ACTIVE = 'Y';
    case INACTIVE = 'N';
}
