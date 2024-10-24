<?php

namespace Bildvitta\IssCrm\Rules;

use Bildvitta\IssCrm\Traits\UsesCrmDB;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExistsOnCrmDBRule implements Rule
{
    use UsesCrmDB;

    protected $table;

    protected $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;

        $this->configDbConnection();
    }

    public function passes($attribute, $value)
    {
        return DB::connection('iss-crm')
            ->table($this->table)
            ->where($this->column, $value)
            ->exists();
    }

    public function message()
    {
        return __('validation.exists');
    }
}
