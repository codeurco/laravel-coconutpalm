<?php

namespace Codeurco\Coconutpalm\Facades;

use Illuminate\Support\Facades\Facade;

class Coconutpalm extends Facade
{
	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'coconutpalm';
    }
}