<?php

namespace Bildvitta\IssCrm\Models\CreditProcess;

use Bildvitta\IssCrm\Models\Customer\Customer;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class CreditProcessStatus extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'credit_process_statuses';

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

    public function credit_process()
    {
        return $this->belongsTo(CreditProcess::class, 'credit_process_id', 'id')->withTrashed();
    }

    public function credit_agent_status()
    {
        return $this->belongsTo(CreditAgentStatus::class, 'credit_agent_status_id', 'id')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withTrashed();
    }
}
