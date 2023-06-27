<?php

namespace Src\Providers;

use Src\Providers\AbstractService;

class ApiKeyMiddleware {
    /**
     * @param mixed $request
     * @param mixed $response
     * @param mixed $next
     * Novo middleware que verifica a validade da x-api-key
     * @return [type]
     */
    public function __invoke($request, $response, $next) {
        $isValidApi = new AbstractService;
        $apiKey = $request->getHeaderLine('X-Api-Key');
        if (!$isValidApi->isValidApiKey($apiKey)) {
            $responseData = ['error' => 'X-Api-Key inválida'];
            return $response->withJson($responseData, 401);
        }
        $response = $next($request, $response);
        $response
        ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }
}
