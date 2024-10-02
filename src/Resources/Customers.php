<?php

namespace Bildvitta\IssCrm\Resources;

use Bildvitta\IssCrm\Contracts\Resources\CustomerContract;
use Bildvitta\IssCrm\IssCrm;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Config;

/**
 * Class Customers.
 */
class Customers implements CustomerContract
{
    private IssCrm $crm;

    /**
     * Customers constructor.
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    /**
     * @throws RequestException
     */
    public function search(array $query = []): object
    {
        return $this->crm->request->get(self::ENDPOINT_PREFIX, $query)->throw()->object();
    }

    /**
     * @throws RequestException
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }

    public function getShowUrl(string $uuid): string
    {
        $redirect_uri = Config::get('iss-crm.front_uri').Config::get('iss-crm.redirects.customers.show');

        return vsprintf($redirect_uri, [$uuid]);
    }
}
