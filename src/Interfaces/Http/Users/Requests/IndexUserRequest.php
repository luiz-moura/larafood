<?php

namespace Interfaces\Http\Users\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexUserRequest extends AbstractRequest
{
    use Paginable;
}
