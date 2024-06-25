<?php

namespace Bildvitta\IssCrm\Scopes\Channel;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if ($user = auth()->user()) {
            $builder->whereHas('hub_company', function ($query) use ($user) {
                $query->where('uuid', $user->company?->uuid);
            });
        }
    }
}
