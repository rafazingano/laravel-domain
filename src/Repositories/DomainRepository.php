<?PHP

namespace ConfrariaWeb\Domain\Repositories;

use ConfrariaWeb\Domain\Contracts\DomainContract;
use ConfrariaWeb\Domain\Models\Domain;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class DomainRepository implements DomainContract
{
    use RepositoryTrait;

    function __construct(Domain $domain)
    {
        $this->obj = $domain;
    }

}