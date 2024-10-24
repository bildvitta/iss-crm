<?php

namespace Bildvitta\IssCrm\Contracts\Resources;

use Illuminate\Http\Client\RequestException;

/**
 * Interface ChannelContract.
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
     * @throws RequestException
     */
    public function search(array $query = []): object;

    /**
     * @throws RequestException
     */
    public function find(string $uuid): object;
}
