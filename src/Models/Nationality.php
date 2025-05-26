<?php

namespace Bildvitta\IssCrm\Models;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'nationalities';

    protected $guard_name = 'web';
}
