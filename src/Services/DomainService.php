<?PHP

namespace ConfrariaWeb\Domain\Services;

use ConfrariaWeb\Domain\Contracts\DomainContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;

class DomainService {

    use ServiceTrait;

    public function __construct(DomainContract $domain)
    {
        $this->obj = $domain;
    }

}
