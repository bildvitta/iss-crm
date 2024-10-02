<?php

namespace Bildvitta\IssCrm\Resources\Programmatic\Customers;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers\FactsContract;
use Bildvitta\IssCrm\IssCrm;

class Facts implements FactsContract
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
     * {@inheritDoc}
     */
    public function create(string $customer_uuid, array $data): object
    {
        return $this->crm->request->post(
            vsprintf(self::ENDPOINT_PREFIX, [$customer_uuid]),
            $data
        )->throw()->object();
    }
}
