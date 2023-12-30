<?php

declare(strict_types=1);

use \Nyholm\Psr7\Factory\Psr17Factory;

use function DI\autowire;

$builder = new DI\ContainerBuilder();

$definitions = [
    Psr17Factory::class => $psr17Factory = new Psr17Factory(),
    Psr\Http\Message\RequestFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\ResponseFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\ServerRequestFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\StreamFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\UploadedFileFactoryInterface::class => $psr17Factory,
    Psr\Http\Message\UriFactoryInterface::class => $psr17Factory,
    \Nyholm\Psr7Server\ServerRequestCreator::class => autowire(),
    // Controllers
    \Hiroya\YuyuArticlesBackend\Http\Controllers\HelloWorldController::class => autowire()
];

$builder->addDefinitions($definitions);
return $builder->build();
