<?php

namespace Src\Providers;

use Src\Providers\AbstractService;

class ApiKeyMiddleware {
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
