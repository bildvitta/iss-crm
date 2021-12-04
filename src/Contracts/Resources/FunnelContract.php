<?php

namespace Bildvitta\IssCrm\Contracts\Resources;

use Illuminate\Http\Client\RequestException;

/**
 * Interface FunnelContract.
 *
 * @package Bildvitta\IssCrm\Contracts\Resources
 */
interface FunnelContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/funnels';

    /**
     * @const string
     */
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX.'/%s';

    /**
     * @param  array  $query
     *
     * @return object
     *
     * @throws RequestException
     */
    public function search(array $query = []): object;

    /**
     * @param  string  $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object;
}
