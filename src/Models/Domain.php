<?php

namespace ConfrariaWeb\Domain\Models;

use App\Models\User;
use ConfrariaWeb\Domain\Scopes\AccountDomainScope;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Domain extends Model
{

    use HasRelationships;

    protected $fillable = [
        'domain', 'user_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new AccountDomainScope());
    }

    /*public function accounts()
    {
        return $this->hasManyDeepFromRelations($this->user(), (new User)->accounts());
    }*/

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
