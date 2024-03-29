<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers;

use Illuminate\Http\Client\RequestException;

/**
 * Interface DocumentsContract.
 *
 * @package Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers
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
    public const ENDPOINT_SALES_DOCUMENTS = self::ENDPOINT_PREFIX . '/sales?limit=%s&offset=%s';

    /**
     * @param string $uuid
     * @param array $query
     *
     * @return object
     *
     * @throws RequestException
     */
    public function search(string $uuid, array $query = []): object;

    /**
     * @param string $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object;

    /**
     * @param string $customer_uuid
     * @param array $data
     *
     * @return object
     *
     * @throws RequestException
     */
    public function create(string $customer_uuid, array $data): object;

    /**
     * @param string $uuid
     * @param int $limit
     * @param int $offset
     *
     * @return object
     *
     * @throws RequestException
     */
    public function salesDocuments(string $uuid, int $limit = 12, int $offset = 0): object;
}
