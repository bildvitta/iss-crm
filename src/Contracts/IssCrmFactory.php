<?php

namespace Bildvitta\IssCrm\Contracts;

use Bildvitta\IssCrm\Resources\Customers;

/**
 * Interface IssCrmFactory.
 */
interface IssCrmFactory
{
    /**
     * @const array
     */
    public const DEFAULT_HEADERS = [
        'content-type' => 'application/json',
        'accept' => 'application/json',
        'User-Agent' => 'ISS v0.0.1-alpha',
    ];

    /**
     * @const array
     */
    public const DEFAULT_OPTIONS = ['allow_redirects' => false];

    public function customers(): Customers;
}
