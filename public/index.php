<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Hiroya\YuyuArticlesBackend\Http\Middlewares;
use Nyholm\Psr7Server\ServerRequestCreator;
use Relay\Relay;

// DIコンテナの設定を読み込む
$container = require __DIR__ . '/../src/dependency-injection.php';

$creator = $container->get(ServerRequestCreator::class);

// スーパーグローバル変数を使わず、ここで取得したリクエストを使うようにする
$serverRequest = $creator->fromGlobals();

require __DIR__ . '/../src/routes.php';
$router = Hiroya\YuyuArticlesBackend\createRouter($container);

$queue = [
    $container->get(Middlewares\StrawMiddleware::class),
    $router
];

$relay = new Relay($queue);
$response = $relay->handle($serverRequest);

(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
