<?php

namespace Bildvitta\IssCrm\Resources\Programmatic;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\CustomerContract;
use Bildvitta\IssCrm\Contracts\Resources\Programmatic\DocumentsContract;
use Bildvitta\IssCrm\IssCrm;
use stdClass;

class Documents implements DocumentsContract
{
    /**
     * @var IssCrm
     */
    private IssCrm $crm;

    /**
     * @var array
     */
    private array $query;

    /**
     *
     * Customers constructor.
     *
     * @param IssCrm $crm
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
        $this->query = [];
    }

    /**
     * @inheritDoc
     */
    public function search(string $uuid, array $query = []): object
    {
        if (empty($query)) {
            $query = $this->query;
        }
        return $this->crm->request->get(vsprintf(self::ENDPOINT_PREFIX, [$uuid]), $query)->throw()->object();
    }

    /**
     * @inheritDoc
     */
    public function find(string $uuid): object
    {
        if (empty($query)) {
            $query = $this->query;
        }
        return $this->crm->request->get(vsprintf(self::ENDPOINT_PREFIX, [$uuid]), $query)->throw()->object();
    }
}
