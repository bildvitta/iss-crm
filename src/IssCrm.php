<?php

namespace Bildvitta\IssCrm;

use Bildvitta\IssCrm\Contracts\IssCrmFactory;
use Bildvitta\IssCrm\Resources\Customers;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

/**
 * Class IssCrm.
 *
 * @package Bildvitta\IssCrm
 */
class IssCrm extends HttpClient implements IssCrmFactory
{
    /**
     * @var PendingRequest
     */
    public PendingRequest $request;

    /**
     * @var string
     */
    private string $token;

    /**
     * Hub constructor.
     *
     * @param  string  $token
     */
    public function __construct(string $token)
    {
        parent::__construct();

        $this->token = $token;

        $this->request = $this->prepareRequest();
    }

    /**
     * @return PendingRequest
     */
    private function prepareRequest(): PendingRequest
    {
        return $this->request = Http::withToken($this->token)
            ->baseUrl(Config::get('iss-crm.base_uri').Config::get('iss-crm.prefix'))
            ->withOptions(self::DEFAULT_OPTIONS)
            ->withHeaders(self::DEFAULT_HEADERS);
    }

    /**
     * @return Customers
     */
    public function customers(): Customers
    {
        return new Customers($this);
    }
}
