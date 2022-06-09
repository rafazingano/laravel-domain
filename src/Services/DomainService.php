<?PHP

namespace ConfrariaWeb\Domain\Services;

use ConfrariaWeb\Domain\Models\Domain;
use Illuminate\Support\Facades\Auth;

use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Endpoints\DNS;
use Cloudflare\API\Endpoints\User;
use Cloudflare\API\Endpoints\Zones;

class DomainService
{

    public $dns;
    public $user;
    public $zones;

    public function __construct()
    {
        $key            = new APIKey('confrariaweb@gmail.com', '50066998dcccfbae70b0cf41c7990c2545ef0');
        $adapter        = new Guzzle($key);
        $this->user     = new User($adapter);
        $this->dns      = new DNS($adapter);
        $this->zones    = new Zones($adapter);

        //$zoneID = $this->zones->getZoneID("confrariaweb.com.br");
        /*foreach ($dns->listRecords($zoneID)->result as $record) {
            echo $record->type." ".$record->name.PHP_EOL;
        }*/
        //dd($user->getUserID(), $dns->listRecords($zoneID)->result);
    }

    public function find($id)
    {
        return Domain::find($id);
    }

    public function getZonebyDomain($domain){
        $zoneID = $this->zones->getZoneID($domain);
        return $this->zones->getZoneById($zoneID)->result;
    }

    public function all()
    {
        return Domain::all();
    }

    public function pluck()
    {
        return Domain::pluck('domain', 'id')->all();
    }

    public function create(array $data)
    {
        if(empty($data['user_id'])){
            $data['user_id'] = Auth::id();
        }
        $domain = Domain::create($data);
        if($domain){
            $addZone = $this->zones->addZone($domain->domain);
        }
        return $domain;       
    }

    public function update($id, array $data)
    {
        $domain = Domain::find($id);
        return $domain->update($data);
    }

}
