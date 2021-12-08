<?php

namespace Bildvitta\IssCrm\Resources\Programmatic;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\CustomerContract;
use Bildvitta\IssCrm\IssCrm;

class Customers implements CustomerContract
{
    /**
     * @var IssCrm
     */
    private IssCrm $crm;

    /**
     *
     * Customers constructor.
     *
     * @param IssCrm $crm
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    /**
     * @inheritDoc
     */
    public function search(array $query = []): object
    {
        return $this->crm->request->get(self::ENDPOINT_PREFIX, $query)->throw()->object();
    }

    /**
     * @inheritDoc
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }
}
