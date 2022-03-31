<?php

namespace Bildvitta\IssCrm\Resources\Programmatic\Customers;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers\CustomerContract;
use Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers\DocumentsContract;
use Bildvitta\IssCrm\IssCrm;
use stdClass;

class Documents implements DocumentsContract
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
    public function search(string $uuid, array $query = []): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_PREFIX, [$uuid]), $query)->throw()->object();
    }

    /**
     * @inheritDoc
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_PREFIX, [$uuid]))->throw()->object();
    }
}
