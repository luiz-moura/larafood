<?php

namespace Interfaces\Http\Permissions\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexPermissionRequest extends AbstractRequest
{
    use Paginable;
}
