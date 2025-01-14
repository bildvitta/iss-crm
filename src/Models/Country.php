<?php

namespace Bildvitta\IssCrm\Models;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'countries';

    protected $guard_name = 'web';
}
