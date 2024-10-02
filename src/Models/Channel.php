<?php

namespace Bildvitta\IssCrm\Models;

use Bildvitta\IssCrm\Models\Hub\HubCompany;
use Bildvitta\IssCrm\Scopes\Channel\CompanyScope;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Channel extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'channels';

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

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function channels()
    {
        return $this->hasMany(Channel::class, 'channel_id', 'id');
    }

    public function hub_company()
    {
        return $this->belongsTo(HubCompany::class, 'company_id', 'id');
    }
}
