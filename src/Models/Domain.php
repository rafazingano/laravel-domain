<?php

namespace ConfrariaWeb\Domain\Models;

use ConfrariaWeb\Account\Traits\AccountTrait;
use ConfrariaWeb\Domain\Scopes\AccountDomainScope;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Domain extends Model
{

    use AccountTrait;
    use HasRelationships;

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

}
