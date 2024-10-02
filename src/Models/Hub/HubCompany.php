<?php

namespace Bildvitta\IssCrm\Models\Hub;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HubCompany extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'hub_companies';

    protected $guard_name = 'web';

    public function getRouteKeyName()
    {
        return 'hub_uuid';
    }

    //
}
