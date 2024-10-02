<?php

namespace Bildvitta\IssCrm\Models\CreditProcess;

use Bildvitta\IssCrm\Models\Bank;
use Bildvitta\IssCrm\Models\Hub\User;
use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class CreditProcessSimulator extends Model
{
    use SoftDeletes;
    use UsesCrmDB;

    protected $connection = 'iss-crm';

    protected $table = 'credit_process_simulators';

    protected $guard_name = 'web';

    public const MODALITY = [
        'mcvc' => 'MCMV',
        'sbpe' => 'SBPE',
        'venda_direta' => 'VENDA DIRETA',
        'ccfgts' => 'CCFGTS',
    ];

    public const AMORTIZATION_SYSTEM = [
        'price' => 'Tabela Price',
        'sacoc' => 'SACOC',
        'sac' => 'SAC',
    ];

    public const STATUS = [
        'document-approved' => 'Análise documental aprovada',
        'bank-analysis' => 'Em análise bancária',
        'bank-approved' => 'Análise bancária aprovada',
    ];

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

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withTrashed();
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')->withTrashed();
    }
}
