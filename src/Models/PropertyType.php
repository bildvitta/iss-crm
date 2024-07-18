<?php

namespace Bildvitta\IssCrm\Models;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class PropertyType extends Model
{
    use UsesCrmDB;
    use SoftDeletes;

    protected $connection = 'iss-crm';
    
    protected $table = 'property_types';

    protected $guard_name = 'web';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string)Uuid::uuid4();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    //
}
