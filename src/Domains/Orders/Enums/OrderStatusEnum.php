<?php

namespace Domains\Orders\Enums;

enum OrderStatusEnum: string
{
    case OPEN = 'open';
    case DONE = 'done';
    case REJECT = 'reject';
    case WORKING = 'working';
    case CANCELED = 'canceled';
    case DELIVERING = 'delivering';
}
