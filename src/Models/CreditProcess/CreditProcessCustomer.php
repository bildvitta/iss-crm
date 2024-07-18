<?php

namespace Bildvitta\IssCrm\Models\CreditProcess;

use Bildvitta\IssCrm\Models\Customer\Customer;
use Bildvitta\IssCrm\Scopes\Customer\RealEstateAgencyScope;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class CreditProcessCustomer extends Model
{
    use UsesCrmDB;
    use SoftDeletes;

    protected $connection = 'iss-crm';
    
    protected $table = 'credit_process_customers';

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

    public function credit_process()
    {
        return $this->belongsTo(CreditProcess::class, 'credit_process_id', 'id')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withoutGlobalScope(RealEstateAgencyScope::class)->withTrashed();
    }

    public function parent()
    {
        return $this->belongsTo(CreditProcessCustomer::class, 'parent_id', 'id')->withTrashed();
    }

    public function children()
    {
        return $this->hasMany(CreditProcessCustomer::class, 'parent_id', 'id');
    }
}
