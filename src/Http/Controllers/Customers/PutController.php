<?php

namespace Bildvitta\IssCrm\Http\Controllers\Customers;

use Bildvitta\IssCrm\Http\Controllers\Documents\CustomerController;
use Bildvitta\IssCrm\Http\Requests\Customers\PutRequest;
use Bildvitta\IssCrm\Models\Customer\Customer as CustomerCRM;
use Illuminate\Http\JsonResponse;

class PutController extends CustomerController
{
    public function __invoke(PutRequest $request, CustomerCRM $customer): JsonResponse
    {
        $data = $request->validated();

        $response = app('crm')->customers()->update($customer->uuid, $data);

        return response()->json(
            $response,
            $response->status->code
        );
    }
}
