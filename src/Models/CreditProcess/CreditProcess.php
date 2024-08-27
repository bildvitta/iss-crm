<?php

namespace Bildvitta\IssCrm\Models\CreditProcess;

use Bildvitta\IssCrm\Models\Customer\Customer;
use Bildvitta\IssCrm\Models\Hub\HubCompany;
use Bildvitta\IssCrm\Models\Hub\User;
use Bildvitta\IssCrm\Models\Produto\RealEstateDevelopment\RealEstateDevelopment;
use Bildvitta\IssCrm\Models\Produto\RealEstateDevelopment\Typology;
use Bildvitta\IssCrm\Models\Sale;
use Bildvitta\IssCrm\Scopes\Customer\RealEstateAgencyScope;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class CreditProcess extends Model
{
    use UsesCrmDB;
    use SoftDeletes;

    protected $connection = 'iss-crm';
    
    protected $table = 'credit_processes';

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

    public function credit_agent()
    {
        return $this->belongsTo(CreditAgent::class, 'credit_agent_id', 'id')->withTrashed();
    }

    public function credit_agent_queue()
    {
        return $this->belongsTo(CreditAgentQueue::class, 'credit_agent_queue_id', 'id')->withTrashed();
    }

    public function credit_agent_status()
    {
        return $this->belongsTo(CreditAgentStatus::class, 'credit_agent_status_id', 'id')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withoutGlobalScope(RealEstateAgencyScope::class)->withTrashed();
    }

    public function real_estate_agency()
    {
        return $this->belongsTo(HubCompany::class, 'real_estate_agency_id', 'id')->withTrashed();
    }

    public function broker()
    {
        return $this->belongsTo(User::class, 'broker_id', 'id')->withTrashed();
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id')->withTrashed();
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id')->withTrashed();
    }

    public function real_estate_development()
    {
        return $this->belongsTo(RealEstateDevelopment::class, 'real_estate_development_id', 'id')->withTrashed();
    }

    public function typology()
    {
        return $this->belongsTo(Typology::class, 'typology_id', 'id')->withTrashed();
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id')->withTrashed();
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withTrashed();
    }

    public function credit_process_statuses()
    {
        return $this->hasMany(CreditProcessStatus::class, 'credit_process_id', 'id');
    }

    public function credit_process_customers()
    {
        return $this->hasMany(CreditProcessCustomer::class, 'credit_process_id', 'id');
    }

    public function simulators()
    {
        return $this->hasMany(CreditProcessSimulator::class, 'credit_process_id', 'id');
    }
}
