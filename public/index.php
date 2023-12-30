<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use \Nyholm\Psr7\Factory\Psr17Factory;
use \Nyholm\Psr7Server\ServerRequestCreator;
use \Hiroya\YuyuArticlesBackend\Http\Controllers\HelloWorldController;

// DIコンテナの設定を読み込む
$container = require __DIR__ . '/../src/dependency-injection.php';

$creator = $container->get(ServerRequestCreator::class);

// スーパーグローバル変数を使わず、ここで取得したリクエストを使うようにする
$serverRequest = $creator->fromGlobals();

// 後でルーティング出来るようにする
$response = ($container->get(HelloWorldController::class))->handle($serverRequest);

(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
