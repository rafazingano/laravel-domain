<?php

namespace ConfrariaWeb\Domain\Models;

use ConfrariaWeb\Domain\Scopes\DomainScope;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'domain', 'user_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new DomainScope);
    }
}
