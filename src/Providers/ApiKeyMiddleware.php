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
            return $response->withStatus(401);
        }
        $response = $next($request, $response);
        return $response;
    }
}
