<?php

declare(strict_types=1);

namespace Hiroya\YuyuArticlesBackend;

use Hiroya\YuyuArticlesBackend\Http\Controllers\HelloWorldController;
use MakiseCo\Http\Router\RouteCollectorFactory;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

function createRouter(ContainerInterface $container): RequestHandlerInterface
{
    $collector = (new RouteCollectorFactory())->create(
        $container
    );

    $collector->get('/', [HelloWorldController::class, 'handle']);

    return $collector->getRouter();
}
