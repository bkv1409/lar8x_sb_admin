<?php

namespace Bkv1409\SystemConfig\Facades;

use Illuminate\Support\Facades\Facade;

class SystemConfig extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'system-config';
    }
}
