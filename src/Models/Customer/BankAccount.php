<?php

namespace Bildvitta\IssCrm\Models\Customer;

use Bildvitta\IssCrm\Models\Bank;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class BankAccount extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'customer_bank_accounts';

    protected $guard_name = 'web';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    //

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withTrashed();
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id')->withTrashed();
    }
}
