<?php

namespace Infrastructure\Shared;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Infrastructure\Contracts\ControllerContract;

class Controller extends BaseController implements ControllerContract
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}
