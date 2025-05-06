<?php

namespace Bildvitta\IssCrm\Models\Customer;

use Bildvitta\IssCrm\Models\Channel;
use Bildvitta\IssCrm\Models\CivilStatus;
use Bildvitta\IssCrm\Models\Country;
use Bildvitta\IssCrm\Models\Hub\HubCompany;
use Bildvitta\IssCrm\Models\Hub\User;
use Bildvitta\IssCrm\Models\Occupation;
use Bildvitta\IssCrm\Models\OccupationType;
use Bildvitta\IssCrm\Scopes\CompanyScope;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Customer extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'customers';

    protected $guard_name = 'web';

    public const GENDER_LIST = [
        'male' => 'Masculino',
        'female' => 'Feminino',
        'other' => 'Outro',
    ];

    public const TYPE_LIST = [
        'cpf' => 'Pessoa física',
        'cnpj' => 'Pessoa jurídica',
    ];

    public const KIND_LIST = [
        'main' => 'Contato principal',
        'customer' => 'Cliente',
        'guarantor' => 'Fiador',
        'representative' => 'Representante',
        'spouse' => 'Cônjuge',
        'procurator' => 'Procurador',
        'joint_purchase' => 'Compra conjunta',
    ];

    public const PWD_TYPE_LIST = [
        'visual' => 'Visual',
        'hearing' => 'Auditiva',
        'mental' => 'Intelectual',
        'physical' => 'Física',
        'multiple' => 'Múltipla',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope('real_estate_agency', 'real_estate_agency_id'));
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function real_estate_broker()
    {
        return $this->user();
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id', 'id')->withTrashed();
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id')->withTrashed();
    }

    public function real_estate_agency()
    {
        return $this->belongsTo(HubCompany::class, 'real_estate_agency_id', 'id')->withTrashed();
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id')->withoutGlobalScopes()->withTrashed();
    }

    public function subchannel()
    {
        return $this->belongsTo(Channel::class, 'subchannel_id', 'id')->withoutGlobalScopes()->withTrashed();
    }

    public function bonds()
    {
        return $this->belongsToMany(Customer::class, 'customer_bonds', 'customer_id', 'bond_customer_id')
            ->withoutGlobalScopes()
            ->withPivot('kind')
            ->withPivot('id')
            ->withTimestamps();
    }

    public function civil_status()
    {
        return $this->belongsTo(CivilStatus::class, 'civil_status_id', 'id')->withTrashed();
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id', 'id')->withTrashed();
    }

    public function occupation_type()
    {
        return $this->belongsTo(OccupationType::class, 'occupation_type_id', 'id')->withTrashed();
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'customer_id', 'id');
    }

    public function formal_incomes()
    {
        return $this->hasMany(FormalIncome::class, 'customer_id', 'id');
    }

    public function informal_incomes()
    {
        return $this->hasMany(InformalIncome::class, 'customer_id', 'id');
    }

    public function heritage_cars()
    {
        return $this->hasMany(HeritageCar::class, 'customer_id', 'id');
    }

    public function heritage_properties()
    {
        return $this->hasMany(HeritageProperty::class, 'customer_id', 'id');
    }

    public function bank_accounts()
    {
        return $this->hasMany(BankAccount::class, 'customer_id', 'id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    public function scopeHasCompleteRegistration(Builder $query): Builder
    {
        return $query->whereNotNull([
            'name',
            'document',
            'civil_status_id',
            'gender',
            'birthday',
        ])->where(function ($query) {
            $query->whereNotNull('email')
                ->orWhereNotNull('phone')
                ->orWhereNotNull('phone_two');
        });
    }

    public function isIncompleteRegistration(): Attribute
    {
        return Attribute::get(function () {
            $requiredAttributes = [
                'name',
                'document',
                'civil_status_id',
                'gender',
                'birthday',
            ];

            $hasMissingAttributes = collect($requiredAttributes)->contains(fn ($attribute) => empty($this->$attribute));

            $hasNoContactInfo = empty($this->email) && empty($this->phone) && empty($this->phone_two);

            return $hasMissingAttributes || $hasNoContactInfo;
        })->shouldCache();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function calling_code_phone()
    {
        return $this->belongsTo(Country::class, 'calling_code_phone_id', 'id');
    }

    public function calling_code_phone_two()
    {
        return $this->belongsTo(Country::class, 'calling_code_phone_two_id', 'id');
    }
}
