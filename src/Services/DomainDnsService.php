<?PHP

namespace ConfrariaWeb\Domain\Services;

use ConfrariaWeb\Domain\Contracts\DomainDnsContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;

class DomainDnsService {

    use ServiceTrait;

    public function __construct(DomainDnsContract $dns)
    {
        $this->obj = $dns;
    }

}
