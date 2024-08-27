<?php

namespace Bildvitta\IssCrm\Contracts\Resources\Programmatic\CreditProcesses;

interface CreditProcessContract
{
    public const ENDPOINT_PREFIX = '/programmatic/credit-processes';

    public function store(array $payload): object;
}
