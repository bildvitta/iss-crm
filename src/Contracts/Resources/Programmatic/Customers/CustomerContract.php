<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers;

use Illuminate\Http\Client\RequestException;

/**
 * Interface CustomerContract.
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
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX.'/%s';

    /**
     * @const string
     */
    public const ENDPOINT_UPDATE = self::ENDPOINT_PREFIX.'/%s';

    /**
     * @const string
     */
    public const ENDPOINT_CHANGE_REAL_ESTATE_BROKER = self::ENDPOINT_PREFIX.'/change-real-estate-broker';

    /**
     * @throws RequestException
     */
    public function search(array $query = []): object;

    /**
     * @throws RequestException
     */
    public function find(string $uuid): object;

    public function update(string $uuid, array $data): object;
}
