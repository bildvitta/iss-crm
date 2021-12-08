<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic;

use Illuminate\Http\Client\RequestException;

/**
 * Interface CustomerContract.
 *
 * @package Bildvitta\IssCrm\Contracts\Resources
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
}
