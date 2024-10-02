<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers;

use Illuminate\Http\Client\RequestException;

/**
 * Interface FactsContract.
 */
interface FactsContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/customers/%s/facts';

    /**
     * @throws RequestException
     */
    public function create(string $customer_uuid, array $data): object;
}
