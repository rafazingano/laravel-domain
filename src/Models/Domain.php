<?php

namespace ConfrariaWeb\Domain\Models;

use ConfrariaWeb\Account\Traits\AccountTrait;
use ConfrariaWeb\Domain\Scopes\AccountDomainScope;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{

    use AccountTrait;

    protected $fillable = [
        'domain', 'user_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new AccountDomainScope());
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function sites()
    {
        return $this->belongsToMany('ConfrariaWeb\Site\Models\Site');
    }

    public function dns(){
        return $this->hasMany('ConfrariaWeb\Domain\Models\DomainDns');
    }

}
