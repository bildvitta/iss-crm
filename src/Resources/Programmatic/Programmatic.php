<?php

namespace Bildvitta\IssCrm\Resources\Programmatic;

use Bildvitta\IssCrm\IssCrm;
use Bildvitta\IssCrm\Resources\Programmatic\Customers\Customers;

class Programmatic
{
    /**
     * @var IssCrm
     */
    private IssCrm $crm;

    /**
     * Customers constructor.
     *
     * @param IssCrm $crm
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    public function customers(): Customers
    {
        return new Customers($this->crm);
    }

    public function channels(): Channels
    {
        return new Channels($this->crm);
    }

    public function funnels(): Funnels
    {
        return new Funnels($this->crm);
    }
}
