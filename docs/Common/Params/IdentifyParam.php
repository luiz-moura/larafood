<?php

namespace Docs\Common\Params;

use OpenApi\Attributes as OA;

class IdentifyParam
{
    #[OA\Parameter(
        name: "identify",
        description: "Identify.",
        required: true,
        in: "path",
        schema: new OA\Schema(type: 'string')
    )]
    public string $identify;
}
