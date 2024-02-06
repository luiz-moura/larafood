<?php

namespace Docs\Common\Params;

use OpenApi\Attributes as OA;

class CompanyTokenParam
{
    #[OA\Parameter(
        name: "company_token",
        description: "Company token",
        required: true,
        in: "header",
        schema: new OA\Schema(type: 'string')
    )]
    public string $company_token;
}
