<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;

class OpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(private openApiFactoryInterface $decorated)
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['bearerAuth'] = new \ArrayObject([
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT'
        ]);

        return $openApi;
    }
}
