<?php
require_once __DIR__ . '/../src/vendor/autoload.php';
use Src\Routes\ApiRoutes;

$contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';

if ($contentType === 'application/json') {
    $apiRoutes = new ApiRoutes();
} else {
    echo 'site';
}