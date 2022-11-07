<?php

namespace Interfaces\Http\Profiles\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexProfileRequest extends AbstractRequest
{
    use Paginable;
}
