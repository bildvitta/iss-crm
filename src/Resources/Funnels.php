<?php

namespace Bildvitta\IssCrm\Resources;

use Bildvitta\IssCrm\Contracts\Resources\FunnelContract;
use Bildvitta\IssCrm\IssCrm;
use Illuminate\Http\Client\RequestException;

/**
 * Class Funnels.
 */
class Funnels implements FunnelContract
{
    private IssCrm $crm;

    /**
     * Funnels constructor.
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
}
