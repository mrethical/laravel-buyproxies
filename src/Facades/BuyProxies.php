<?php

namespace Mrethical\BuyProxies\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mrethical\BuyProxies\BuyProxies
 */
class BuyProxies extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mrethical\BuyProxies\BuyProxies::class;
    }
}
