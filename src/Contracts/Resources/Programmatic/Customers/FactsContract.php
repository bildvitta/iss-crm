<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers;

use Illuminate\Http\Client\RequestException;

/**
 * Interface FactsContract.
 *
 * @package Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers
 */
interface FactsContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/customers/%s/facts';

    /**
     * @param string $customer_uuid
     * @param array $data
     *
     * @return object
     *
     * @throws RequestException
     */
    public function create(string $customer_uuid, array $data): object;
}
