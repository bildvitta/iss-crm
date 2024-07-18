<?php

namespace Bildvitta\IssCrm\Models\CreditProcess;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class CreditAgentStatus extends Model
{
    use UsesCrmDB;
    use SoftDeletes;

    protected $connection = 'iss-crm';
    
    protected $table = 'credit_agent_statuses';

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

    public function credit_agent_queue()
    {
        return $this->belongsTo(CreditAgentQueue::class, 'credit_agent_queue_id', 'id')->withTrashed();
    }

    public function credit_processes()
    {
        return $this->hasMany(CreditProcess::class, 'credit_agent_status_id', 'id');
    }
}
