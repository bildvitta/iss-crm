<?php

namespace Bildvitta\IssCrm\Contracts\Resources;

use Illuminate\Http\Client\RequestException;

/**
 * Interface ChannelContract.
 *
 * @package Bildvitta\IssCrm\Contracts\Resources
 */
interface ChannelContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/channels';

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
