<?php

namespace Bildvitta\IssCrm\Models\Customer;

use Bildvitta\IssCrm\Models\PropertyType;
use Bildvitta\IssCrm\Scopes\Customer\RealEstateAgencyScope;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class HeritageProperty extends Model
{
    use UsesCrmDB;
    use SoftDeletes;

    protected $connection = 'iss-crm';
    
    protected $table = 'customer_heritage_properties';

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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')
            ->withoutGlobalScope(RealEstateAgencyScope::class);
    }

    public function property_type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id', 'id');
    }
}
