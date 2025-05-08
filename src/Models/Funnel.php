<?php

namespace Bildvitta\IssCrm\Models;

use Bildvitta\IssCrm\Models\Hub\HubCompany;
use Bildvitta\IssCrm\Scopes\CompanyScope;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Funnel extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'funnels';

    protected $guard_name = 'web';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    //

    public function company()
    {
        return $this->belongsTo(HubCompany::class, 'company_id', 'id')->withTrashed();
    }
}
