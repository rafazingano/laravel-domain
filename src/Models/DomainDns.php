<?php

namespace ConfrariaWeb\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class DomainDns extends Model
{

    protected $fillable = [
        'domain_id', 'type', 'name', 'content', 'ttl', 'proxy', 'options'
    ];

    public function domain()
    {
        return $this->belongsTo('ConfrariaWeb\Domain\Models\Domain');
    }

}
