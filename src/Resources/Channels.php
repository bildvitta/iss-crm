<?php

namespace Bildvitta\IssCrm\Resources;

use Bildvitta\IssCrm\Contracts\Resources\ChannelContract;
use Bildvitta\IssCrm\IssCrm;
use Illuminate\Http\Client\RequestException;

/**
 * Class Channels.
 *
 * @package Bildvitta\IssCrm\Resources
 */
class Channels implements ChannelContract
{
    /**
     * @var IssCrm
     */
    private IssCrm $crm;

    /**
     * Channels constructor.
     *
     * @param  IssCrm  $crm
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    /**
     * @param  array  $query
     *
     * @return object
     *
     * @throws RequestException
     */
    public function search(array $query = []): object
    {
        return $this->crm->request->get(self::ENDPOINT_PREFIX, $query)->throw()->object();
    }

    /**
     * @param  string  $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }
}
