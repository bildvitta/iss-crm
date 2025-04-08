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
     * Get the registered name of the component.
     *
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return \Bildvitta\IssCrm\IssCrm::class;
    }
}
