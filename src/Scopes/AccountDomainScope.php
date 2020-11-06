<?php

namespace ConfrariaWeb\Domain\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AccountDomainScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(!app()->runningInConsole()) {
            $prefix = request()->route()->getPrefix();
            $when = 'dashboard' == $prefix && existsAccount();
            $builder->when($when, function ($query) {
                return $query
                    ->join('account_domain', function ($join) {
                        $join->on('domains.id', '=', 'account_domain.domain_id')
                            ->where('account_domain.account_id', account()->id);
                    });
            }, function ($query) {
                return $query->whereNotNull('user_id');
            });
        }
    }
}