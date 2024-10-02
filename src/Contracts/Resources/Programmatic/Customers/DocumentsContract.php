<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers;

use Illuminate\Http\Client\RequestException;

/**
 * Interface DocumentsContract.
 */
interface DocumentsContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/customers/%s/documents';

    /**
     * @const string
     */
    public const ENDPOINT_SALES_DOCUMENTS = self::ENDPOINT_PREFIX.'/sales?limit=%s&offset=%s';

    /**
     * @throws RequestException
     */
    public function search(string $uuid, array $query = []): object;

    /**
     * @throws RequestException
     */
    public function find(string $uuid): object;

    /**
     * @throws RequestException
     */
    public function create(string $customer_uuid, array $data): object;

    /**
     * @throws RequestException
     */
    public function salesDocuments(string $uuid, int $limit = 12, int $offset = 0): object;
}
