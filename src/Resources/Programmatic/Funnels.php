<?php

namespace Bildvitta\IssCrm\Resources\Programmatic;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\FunnelContract;
use Bildvitta\IssCrm\IssCrm;

class Funnels implements FunnelContract
{
    private IssCrm $crm;

    private array $query = [];

    /**
     * Customers constructor.
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    /**
     * {@inheritDoc}
     */
    public function search(array $query = []): object
    {
        $query = empty($query) ? $this->query : array_merge($query, $this->query);

        return $this->crm->request->get(self::ENDPOINT_PREFIX, $query)->throw()->object();
    }

    /**
     * {@inheritDoc}
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }
}
