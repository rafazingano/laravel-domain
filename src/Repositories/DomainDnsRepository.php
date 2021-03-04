<?PHP

namespace ConfrariaWeb\Domain\Repositories;

use ConfrariaWeb\Domain\Contracts\DomainDnsContract;
use ConfrariaWeb\Domain\Models\DomainDns;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class DomainDnsRepository implements DomainDnsContract
{
    use RepositoryTrait;

    function __construct(DomainDns $dns)
    {
        $this->obj = $dns;
    }

}