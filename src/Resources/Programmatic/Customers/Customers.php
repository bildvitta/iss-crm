<?php

namespace Bildvitta\IssCrm\Resources\Programmatic\Customers;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers\CustomerContract;
use Bildvitta\IssCrm\IssCrm;

class Customers implements CustomerContract
{
    /**
     * @var IssCrm
     */
    private IssCrm $crm;

    /**
     * @var array
     */
    private array $query = [];

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
     * Return a list od Customers By Company Id
     *
     * @param $value
     * @return Customers
     */
    public function searchByCompany($value = null)
    {
        $this->query['company'] = $value;
        return $this;
    }

    /**
     * Return a list od Customers By Complete Registration
     *
     * @return $this
     */
    public function searchByCompleteRegistration()
    {
        $this->query['complete_registration'] = true;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function search(array $query = []): object
    {
        $query = empty($query) ? $this->query : array_merge($query, $this->query);

        return $this->crm->request->get(self::ENDPOINT_PREFIX, $query)->throw()->object();
    }

    /**
     * @inheritDoc
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }

    /**
     * @return Documents
     */
    public function documents(): Documents
    {
        return new Documents($this->crm);
    }

    /**
     * @return Facts
     */
    public function facts(): Facts
    {
        return new Facts($this->crm);
    }

    /**
     * @param  string  $uuid
     * @param array $data
     *
     * @return object
     */
    public function update(string $uuid, array $data): object
    {
        return $this->crm->request->patch(vsprintf(self::ENDPOINT_UPDATE, [$uuid]), $data)->throw()->object();
    }
}
