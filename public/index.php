<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use \Nyholm\Psr7\Factory\Psr17Factory;
use \Nyholm\Psr7Server\ServerRequestCreator;
use \Hiroya\YuyuArticlesBackend\Http\Controllers\HelloWorldController;

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

// スーパーグローバル変数を使わず、ここで取得したリクエストを使うようにする
$serverRequest = $creator->fromGlobals();

// 後でルーティング出来るようにする
$response = (new HelloWorldController(
    $psr17Factory,
    $psr17Factory,
))->handle($serverRequest);

(new \Laminas\HttpHandlerRunner\Emitter\SapiEmitter())->emit($response);
