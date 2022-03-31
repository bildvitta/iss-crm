<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers;

use Illuminate\Http\Client\RequestException;

/**
 * Interface DocumentsContract.
 *
 * @package Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers
 */
interface DocumentsContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/customers/%s/documents';

    /**
     * @param string $uuid
     * @param array $query
     *
     * @return object
     *
     * @throws RequestException
     */
    public function search(string $uuid, array $query = []): object;

    /**
     * @param string $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object;
}
