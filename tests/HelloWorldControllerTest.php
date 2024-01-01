<?php

declare(strict_types=1);

namespace Hiroya\YuyuArticlesBackend;

use Hiroya\YuyuArticlesBackend\Http\Controllers\HelloWorldController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class HelloWorldControllerTest extends TestCase
{
    use Helper\HttpFactoryTrait;

    private HelloWorldController $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new HelloWorldController($this->psr17factory(), $this->psr17factory());
    }

    /**
     * @dataProvider requestProvider
     * @param array{status_code:positive-int,headers:array<string,non-empty-list<string>>,body:string} $expected
     */
    public function test(ServerRequestInterface $request, array $expected): void
    {
        $actual = $this->subject->handle($request);

        $this->assertSame($expected['status_code'], $actual->getStatusCode());
        $this->assertEquals($expected['headers'], $actual->getHeaders());
        $this->assertSame($expected['body'], (string)$actual->getBody());
    }

    /**
     * @return iterable<array{ServerRequestInterface, array{status_code:positive-int,headers:array<string,non-empty-list<string>>,body:string}}>
     */
    public static function requestProvider(): iterable
    {
        yield 'GET' => [
            self::createServerRequest('GET', '/dummy'),
            [
                'status_code' => 200,
                'headers' => [
                    'Content-Type' => ['application/json; charset=UTF-8'],
                ],
                'body' => '{"message":"Hello, World"}',
            ],
        ];
    }
}
