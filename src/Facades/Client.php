<?php

namespace Javleds\Traccar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static get(string $endpoint, array $parameters = [], array $options = [])
 * @method static post(string $endpoint, array $parameters = [], array $options = [])
 * @method static put(string $endpoint, array $parameters = [], array $options = [])
 * @method static delete(string $endpoint, array $parameters = [], array $options = [])
 */
class Client extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'traccar-client';
    }
}
