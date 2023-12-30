<?php

declare(strict_types=1);


namespace Hiroya\YuyuArticlesBackend\Http\Controllers;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HelloWorldController implements RequestHandlerInterface
{
    public function __construct(
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly StreamFactoryInterface   $streamFactory
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $content = [
            "message" => "Hello, World"
        ];
        $content = json_encode($content);

        return $this->responseFactory->createResponse(200)
            ->withHeader('Content-Type', 'application/json; charset=UTF-8')
            ->withBody($this->streamFactory->createStream($content));
    }
}
