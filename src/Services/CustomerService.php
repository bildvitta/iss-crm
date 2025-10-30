<?php

namespace Bildvitta\IssCrm\Services;

use Bildvitta\IssCrm\Models\Customer\Customer as CustomerCRM;
use Illuminate\Http\JsonResponse;

class CustomerService
{
    public function custumerUpdate(array $data, CustomerCRM $customer): JsonResponse
    {
        $response = app('crm')->customers()->update($customer->uuid, $data);

        return response()->json(
            $response,
            $response->status->code
        );
    }
}
