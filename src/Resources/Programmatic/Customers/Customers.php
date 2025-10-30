<?php

namespace Bildvitta\IssCrm\Resources\Programmatic\Customers;

use Bildvitta\IssCrm\Contracts\Resources\Programmatic\Customers\CustomerContract;
use Bildvitta\IssCrm\IssCrm;

class Customers implements CustomerContract
{
    private IssCrm $crm;

    private array $query = [];

    /**
     * Customers constructor.
     */
    public function __construct(IssCrm $crm)
    {
        $this->crm = $crm;
    }

    /**
     * Return a list od Customers By Company Id
     *
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
     * {@inheritDoc}
     */
    public function search(array $query = []): object
    {
        $query = empty($query) ? $this->query : array_merge($query, $this->query);

        return $this->crm->request->get(self::ENDPOINT_PREFIX, $query)->throw()->object();
    }

    /**
     * {@inheritDoc}
     */
    public function find(string $uuid): object
    {
        return $this->crm->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }

    public function documents(): Documents
    {
        return new Documents($this->crm);
    }

    public function facts(): Facts
    {
        return new Facts($this->crm);
    }

    public function update(string $uuid, array $data): object
    {
        return $this->crm->request->patch(vsprintf(self::ENDPOINT_UPDATE, [$uuid]), $data)->throw()->object();
    }

    public function changeRealEstateBroker(array $data): object
    {
        return $this->crm->request->post(self::ENDPOINT_CHANGE_REAL_ESTATE_BROKER, $data)->throw()->object();
    }
}
