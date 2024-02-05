<?php

namespace Docs\v1\Evaluation;

use OpenApi\Attributes as OA;

class StoreEvaluation
{
    #[OA\Post(
        path: '/api/v1/orders/{identify}/evaluations',
        tags: ['Evaluations'],
        summary: 'Evaluate order',
        security: [['api' => []]],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/identify'),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/EvaluationBody")
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'object',
                            ref: '#/components/schemas/EvaluationResponse'
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 403,
                description: 'Forbidden403',
                content: new OA\JsonContent(ref: "#/components/schemas/Forbidden403")
            ),
            new OA\Response(
                response: 404,
                description: 'NotFound404',
                content: new OA\JsonContent(ref: "#/components/schemas/NotFound404")
            ),
            new OA\Response(
                response: 422,
                description: 'PaginationUnprocessableContent422',
                content: new OA\JsonContent(ref: "#/components/schemas/Evaluation422Response")
            ),
        ]
    )]
    public function __wakeup() {}
}
