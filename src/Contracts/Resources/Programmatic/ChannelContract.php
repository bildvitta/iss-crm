<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic;

use Illuminate\Http\Client\RequestException;

/**
 * Interface ChannelContract.
 */
interface ChannelContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/channels';

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
