<?php

namespace Bildvitta\IssCrm\Contracts;

use Bildvitta\IssCrm\Resources\Customers;

/**
 * Interface IssCrmFactory.
 *
 * @package Bildvitta\IssCrm\Contracts
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

    /**
     * @return Customers
     */
    public function customers(): Customers;
}