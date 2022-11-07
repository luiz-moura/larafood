<?php

namespace Interfaces\Http\Tenant\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexTenantRequest extends AbstractRequest
{
    use Paginable;
}
