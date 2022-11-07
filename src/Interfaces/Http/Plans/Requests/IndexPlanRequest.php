<?php

namespace Interfaces\Http\Plans\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexPlanRequest extends AbstractRequest
{
    use Paginable;
}
