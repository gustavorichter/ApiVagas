<?php

namespace Src\Routes;

use Src\Controllers\AbstractController;
use Src\Providers\ApiKeyMiddleware;

$app = new \Slim\App;
$app->group('/api', function () use ($app) {

    $app->get('/getUsers', function ($request, $response, $args) {
        $teste = new AbstractController();
        $user = $teste->usuarios();
        return $response->withJson($user, 200);
    });
})->add(new ApiKeyMiddleware());

$app->run();