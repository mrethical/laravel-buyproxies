<?php

namespace Mrethical\BuyProxies;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Collection;
use RuntimeException;

class BuyProxies
{
    public function all(): Collection
    {
        $client = app()->make(GuzzleClient::class);

        $response = $client->get('https://api.buyproxies.org/?a=showProxies', [
            'query' => [
                'pid' => config('buyproxies.pid'),
                'key' => config('buyproxies.key'),
            ],
        ]);

        $response = $response->getBody()->getContents();
        if ($response === 'Invalid key2 ') {
            throw new RuntimeException('Invalid key.');
        }
        $proxies = array_filter(preg_split('/\r\n|\r|\n/', $response));

        $collection = app()->make(Collection::class);
        foreach ($proxies as $proxy) {
            $proxy = explode(':', $proxy);
            $collection->add((object) [
                'ip' => $proxy[0],
                'port' => $proxy[1],
                'username' => $proxy[2],
                'password' => $proxy[3],
            ]);
        }

        return $collection;
    }
}
