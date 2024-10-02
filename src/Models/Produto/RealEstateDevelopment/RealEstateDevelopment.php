<?php

namespace Bildvitta\IssCrm\Models\Produto\RealEstateDevelopment;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class RealEstateDevelopment extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'produto_real_estate_developments';

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

    public function typologies()
    {
        return $this->hasMany(Typology::class, 'real_estate_development_id', 'id');
    }
}
