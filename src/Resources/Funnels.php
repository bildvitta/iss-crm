<?php

namespace Bildvitta\IssCrm\Resources;

use Bildvitta\IssCrm\Contracts\Resources\FunnelContract;
use Bildvitta\IssCrm\IssCrm;
use Illuminate\Http\Client\RequestException;

/**
 * Class Funnels.
 *
 * @package Bildvitta\IssCrm\Resources
 */
class Funnels implements FunnelContract
{
    /**
     * @var IssCrm
     */
    private IssCrm $crm;

    /**
     * Funnels constructor.
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
}
