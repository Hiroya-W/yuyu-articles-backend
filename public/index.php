<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use \Nyholm\Psr7\Factory\Psr17Factory;

$psr17Factory = new Psr17Factory();

$responseBody = $psr17Factory->createStream('Hello world');
$response = $psr17Factory->createResponse(200)->withBody($responseBody);
(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
