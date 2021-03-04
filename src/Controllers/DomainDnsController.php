<?php

namespace ConfrariaWeb\Domain\Controllers;

use ConfrariaWeb\Domain\Requests\StoreDomainDns;
use ConfrariaWeb\Domain\Requests\UpdateDomainDns;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class DomainDnsController extends Controller
{

    public $data;

    /**
     * DomainDnsController constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    public function datatables($domain)
    {
        $dns = resolve('DomainDnsService')->all();
        return DataTables::of($dns)
            ->addColumn('action', function ($dns) {
                return '<div class="btn-group btn-group-sm float-right" role="group">
                <a href="' . route('dashboard.domains.dns.show', ['domain' => $dns->domain->domain, 'id' => $dns->id]) . '" class="btn btn-info">
                    <i class="glyphicon glyphicon-eye"></i> Ver
                </a>
                <a href="' . route('dashboard.domains.dns.edit', ['domain' => $dns->domain->domain, 'id' => $dns->id]) . '" class="btn btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
                <a class="btn btn-danger" href="' . route('dashboard.domains.dns.destroy', ['domain' => $dns->domain->domain, 'id' => $dns->id]) . '" onclick="event.preventDefault();
                    document.getElementById(\'dns-destroy-form-' . $dns->id . '\').submit();">
                    Deletar
                </a>
                <form id="dns-destroy-form-' . $dns->id . '" action="' . route('dashboard.domains.dns.destroy', ['domain' => $dns->domain->domain, 'id' => $dns->id]) . '" method="POST" style="display: none;">
                    <input name="_method" type="hidden" value="DELETE">    
                    <input name="_token" type="hidden" value="' . csrf_token() . '">
                    <input type="hidden" name="id" value="' . $dns->id . '">
                </form>
            </div>';
            })
            ->make();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($domain)
    {
        $this->data['domain'] = $domain;
        $this->data['dns'] = resolve('DomainDnsService')->all();
        return view(cwView('domains.dns.index', true), $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($domain)
    {
        $this->data['domain'] = resolve('DomainService')->findBy('domain', $domain);
        return view(cwView('domains.dns.create', true), $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDomainDns $request
     * @param $domain
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainDns $request)
    {
        $data = $request->all();
        $domain = resolve('DomainService')->find($data['domain_id']);
        $dns = resolve('DomainDnsService')->create($data);
        return redirect()
            ->route('dashboard.domains.dns.edit', ['domain' => $domain->domain, 'id' => $dns->get('obj')->id])
            ->with('status', __('domain.create.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($domain, $id)
    {
        $DomainDns = resolve('DomainDnsService')->find($id);
        $this->data['dns'] = $DomainDns;
        $this->data['domain'] = $DomainDns->domain;
        return view(cwView('domains.dns.edit', true), $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainDns $request, $id)
    {
        $data = $request->all();
        $dns = resolve('DomainDnsService')->update($data, $id);
        return redirect()
            ->route('dashboard.domains.dns.edit', ['domain' => $dns->domain->domain, 'id' => $id])
            ->with('status', trans('domain.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
