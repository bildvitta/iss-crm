<?php

namespace Bildvitta\IssCrm\Resources\Programmatic;

use Bildvitta\IssCrm\IssCrm;
use Bildvitta\IssCrm\Resources\Programmatic\CreditProcesses\CreditProcess;
use Bildvitta\IssCrm\Resources\Programmatic\Customers\Customers;

class Programmatic
{
    private IssCrm $crm;

    /**
     * Customers constructor.
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

    public function creditProcesses(): CreditProcess
    {
        return new CreditProcess($this->crm);
    }
}
