<?php

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Mrethical\BuyProxies\Facades\BuyProxies;
use function Pest\Laravel\instance;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEmpty;

it('can retrieve proxies', function () {
    assertNotEmpty(BuyProxies::all());
});

it('parses api response correctly', function () {
    instance(
        GuzzleClient::class,
        transform(new MockHandler([
            new Response(200, [], '1.2.3.4:80:user:pass'),
        ]), fn ($handlerStack) => new GuzzleClient(['handler' => $handlerStack])),
    );

    assertEquals((object) [
        'ip' => '1.2.3.4',
        'port' => '80',
        'username' => 'user',
        'password' => 'pass',
    ], BuyProxies::all()->first());
});
