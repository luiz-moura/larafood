<?php

namespace Interfaces\Http\Tables\Requests;

use Interfaces\Http\Common\Requests\AbstractRequest;
use Interfaces\Http\Common\Traits\Paginable;

class IndexTableRequest extends AbstractRequest
{
    use Paginable;
}
