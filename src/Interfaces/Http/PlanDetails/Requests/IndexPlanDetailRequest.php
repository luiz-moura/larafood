<?php

namespace Interfaces\Http\PlanDetails\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexPlanDetailRequest extends AbstractRequest
{
    use Paginable;

    public function rules(): array
    {
        return self::paginationRules();
    }
}
