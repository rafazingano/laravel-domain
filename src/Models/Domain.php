<?php

namespace ConfrariaWeb\Domain\Models;

use ConfrariaWeb\Account\Traits\AccountTrait;
use ConfrariaWeb\Domain\Scopes\DomainScope;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{

    use AccountTrait;

    protected $fillable = [
        'domain', 'user_id'
    ];

    protected static function booted()
    {
        //static::addGlobalScope(new DomainScope);
    }


}
