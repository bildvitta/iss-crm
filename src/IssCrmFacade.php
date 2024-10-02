<?php

namespace Bildvitta\IssCrm;

use Illuminate\Support\Facades\Facade;
use RuntimeException;

/**
 * @see \Bildvitta\IssCrm\IssCrm
 */
class IssCrmFacade extends Facade
{
    /**
     * @const string
     */
    private const FACADE_ACCESSOR = 'iss-crm';

    /**
     * Get the registered name of the component.
     *
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return self::FACADE_ACCESSOR;
    }
}
