<?php

namespace Bildvitta\IssCrm\Models\Hub;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'users';

    protected $guard_name = 'web';

    public function getRouteKeyName()
    {
        return 'hub_uuid';
    }

    //

    public function hubCompany()
    {
        return $this->belongsTo(HubCompany::class, 'company_id', 'id');
    }
}
