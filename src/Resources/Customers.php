<?php

namespace Bildvitta\IssCrm\Resources;

use Bildvitta\IssCrm\Contracts\Resources\CustomerContract;
use Bildvitta\IssCrm\IssCrm;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Config;

/**
 * Class Customers.
 *
 * @package Bildvitta\IssCrm\Resources
 */
class Customers implements CustomerContract
{
    /**
     * @var IssCrm
     */
    private IssCrm $crm;

    /**
     * Customers constructor.
     *
     * @param  IssCrm  $crm
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    /**
     * @param  array  $query
     *
     * @return object
     *
     * @throws RequestException
     */
    public function search(array $query = []): object
    {
        return $this->crm->request->get(self::ENDPOINT_PREFIX, $query)->throw()->object();
    }

    /**
     * @param  string  $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }

    /**
     * @param  string  $uuid
     *
     * @return string
     */
    public function getShowUrl(string $uuid): string
    {
        $redirect_uri = Config::get('iss-crm.front_uri').Config::get('iss-crm.redirects.customers.show');

        return vsprintf($redirect_uri, [$uuid]);
    }
}
