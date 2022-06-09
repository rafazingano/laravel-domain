<?php

namespace ConfrariaWeb\Domain\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{

    use SoftDeletes;
    
    protected $fillable = ['user_id', 'site_id', 'domain', 'status'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        $account = \Illuminate\Support\Facades\Cache::get('account');
        static::addGlobalScope('accountDomain', function (Builder $builder) use ($account) {

            $builder->when($account, function ($query, $account) {
                return $query->orderBy('id');
            }, function ($query) {
                return $query->orderBy('domain');
            });

        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function site()
    {
        return $this->belongsTo('ConfrariaWeb\Site\Models\Site');
    }

    public function dns(){
        return $this->hasMany('ConfrariaWeb\Domain\Models\DomainDns');
    }

}
