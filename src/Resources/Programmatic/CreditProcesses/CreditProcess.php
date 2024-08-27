<?php

namespace Bildvitta\IssCrm\Resources\Programmatic\CreditProcesses;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\CreditProcesses\CreditProcessContract;
use Bildvitta\IssCrm\IssCrm;
use Illuminate\Http\Client\Response;

class CreditProcess implements CreditProcessContract
{
    private IssCrm $crm;

    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    public function store(array $payload): Response
    {
        return $this->crm
            ->request
            ->post(self::ENDPOINT_PREFIX, $payload);
    }
}
