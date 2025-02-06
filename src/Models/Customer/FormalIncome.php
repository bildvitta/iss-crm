<?php

namespace Bildvitta\IssCrm\Models\Customer;

use Bildvitta\IssCrm\Models\Occupation;
use Bildvitta\IssCrm\Models\ProofOfIncomeType;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class FormalIncome extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'customer_formal_incomes';

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
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withoutGlobalScopes()->withTrashed();
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id', 'id')->withTrashed();
    }

    public function proof_of_income_type()
    {
        return $this->belongsTo(ProofOfIncomeType::class, 'proof_of_income_type_id', 'id')->withTrashed();
    }
}
