<?php

namespace ConfrariaWeb\Domain\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class DomainScope implements Scope
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
        $builder->when(Auth::check(), function ($query) {
            return $query->where(function ($query) {
                $query->where('user_id', Auth::id());
            });
        }, function ($query) {
            return $query->whereNotNull('user_id');
        })->orderBy('domain');
    }
}