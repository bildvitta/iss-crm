<?php

namespace Bildvitta\IssCrm;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bildvitta\IssCrm\IssCrm
 */
class IssCrmFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'iss-crm';
    }
}
