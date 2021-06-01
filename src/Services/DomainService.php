<?PHP

namespace ConfrariaWeb\Domain\Services;

use ConfrariaWeb\Domain\Contracts\DomainContract;
use ConfrariaWeb\Vendor\Services\Service;

class DomainService extends Service
{

    public function __construct(DomainContract $domain)
    {
        parent::__construct($domain);
    }

    public function create(array $data)
    {
        $create = parent::create($data);
        if($create->get('error')){
            return $create;
        }
        $create->get('obj')->dns()->createMany([
            [
                'domain_id' => $create->get('obj')->id,
                'type' => 'AAAA',
                'options' => [
                    'hostname' => '@',
                    'ip-address' => '2600:3c01::f03c:92ff:fe15:880d'
                ],
                'ttl' => ''
            ],
            [
                'domain_id' => $create->get('obj')->id,
                'type' => 'AAAA',
                'options' => [
                    'hostname' => 'www',
                    'ip-address' => '2600:3c01::f03c:92ff:fe15:880d'
                ],
                'ttl' => ''
            ]
        ]);
        return $create;
    }

}
