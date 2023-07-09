<?php
require_once __DIR__ . '/../src/vendor/autoload.php';
use Src\Routes\ApiRoutes;

$headers = getallheaders();
$xType = isset($headers['X-Type']) ? $headers['X-Type'] : '';

if ($xType === 'api') {
    $apiRoutes = new ApiRoutes();
} else {
    echo 'site';
}