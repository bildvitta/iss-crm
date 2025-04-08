<?php

namespace Bildvitta\IssCrm\Models\Produto\RealEstateDevelopment;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Typology extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'produto_typologies';

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

    public function real_estate_development()
    {
        return $this->belongsTo(RealEstateDevelopment::class, 'real_estate_development_id', 'id')->withTrashed();
    }
}
