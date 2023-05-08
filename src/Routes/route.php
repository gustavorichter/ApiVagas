<?php

namespace src\Routes;

use src\Controllers\AbstractController;

$app = new \Slim\App;
//$app->get('/users', UserController::class, ':getAllUsers');

$app->get('/teste', function ($request, $response, $args) {
        $payload=[];
        array_push($payload, array("name"=>"Bob"  ,"birth-year"=>1993));
        array_push($payload, array("name"=>"Alice","birth-year"=>1995));

     return $response->withJson($payload,200);
});

$app->get('/testes', function ($request, $response, $args) {
    $teste = new AbstractController();
    $user = $teste->usuarios();
    return $response->withJson($user,200);
});



$app->run();
