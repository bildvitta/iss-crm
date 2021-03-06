<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers;

use Illuminate\Http\Client\RequestException;

/**
 * Interface CustomerContract.
 *
 * @package Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers
 */
interface CustomerContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/customers';

    /**
     * @const string
     */
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX . '/%s';

    /**
     * @const string
     */
    public const ENDPOINT_UPDATE = self::ENDPOINT_PREFIX.'/%s';

    /**
     * @param array $query
     *
     * @return object
     *
     * @throws RequestException
     */
    public function search(array $query = []): object;

    /**
     * @param string $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object;

    /**
     * @param  string  $uuid
     * @param array $data
     *
     * @return object
     */
    public function update(string $uuid, array $data): object;
}
