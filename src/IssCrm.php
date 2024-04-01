<?php

namespace Bildvitta\IssCrm;

use Bildvitta\IssCrm\Contracts\IssCrmFactory;
use Bildvitta\IssCrm\Resources\Programmatic\Channels;
use Bildvitta\IssCrm\Resources\Customers;
use Bildvitta\IssCrm\Resources\Programmatic\Funnels;
use Bildvitta\IssCrm\Resources\Programmatic\Programmatic;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
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
    private ?string $token;

    /**
     * Hub constructor.
     *
     * @param string $token
     */
    public function __construct(?string $token)
    {
        parent::__construct();

        $programatic = true;
        if ($token != '') {
            $programatic = false;
        }

        $this->setToken($token, $programatic);
    }

    /**
     * @param string $token
     * @param bool $programatic
     * @return IssCrm
     * @throws RequestException
     */
    public function setToken(string $token, bool $programatic = false)
    {
        $this->token = $token;

        if ($programatic) {
            $clientId = Config::get('hub.programatic_access.client_id');
            if (Cache::has($clientId)) {
                $accessToken = Cache::get($clientId);
            } else {
                $accessToken = $this->getToken();
                Cache::add($clientId, $accessToken, now()->addSeconds(31536000));
            }
            $this->token = $accessToken;
        }

        $this->prepareRequest();

        return $this;
    }

    /**
     * @return array|mixed
     * @throws RequestException
     */
    private function getToken()
    {
        $hubUrl = Config::get('hub.base_uri') . Config::get('hub.oauth.token_uri');
        $clientId = Config::get('hub.programatic_access.client_id');
        $secretId = Config::get('hub.programatic_access.client_secret');
        $response = Http::asForm()->post($hubUrl, [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $secretId,
            'scope' => '*',
        ]);

        return $response->json('access_token');
    }

    /**
     * @return PendingRequest
     */
    private function prepareRequest(): PendingRequest
    {
        return $this->request = Http::withToken($this->token)
            ->baseUrl(Config::get('iss-crm.base_uri') . Config::get('iss-crm.prefix'))
            ->withOptions(self::DEFAULT_OPTIONS)
            ->withHeaders(self::DEFAULT_HEADERS);
    }

    //

    public function get($url, $query = [])
    {
        return $this->request->get($url, $query);
    }

    public function post($url, $data = [])
    {
        return $this->request->post($url, $data);
    }

    public function put($url, $data = [])
    {
        return $this->request->put($url, $data);
    }

    public function patch($url, $data = [])
    {
        return $this->request->patch($url, $data);
    }

    public function delete($url, $data = [])
    {
        return $this->request->delete($url, $data);
    }

    //

    /**
     * @return Customers
     */
    public function customers(): Customers
    {
        return new Customers($this);
    }

    /**
     * @return Channels
     */
    public function channels(): Channels
    {
        return new Channels($this);
    }

    /**
     * @return Funnels
     */
    public function funnels(): Funnels
    {
        return new Funnels($this);
    }

    /**
     * @return Programmatic
     */
    public function programmatic(): Programmatic
    {
        return new Programmatic($this);
    }
}
