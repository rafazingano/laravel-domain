<?php

namespace ConfrariaWeb\Domain\Controllers;

use ConfrariaWeb\Domain\Models\Domain;
use ConfrariaWeb\Domain\Requests\StoreDomain;
use ConfrariaWeb\Domain\Requests\UpdateDomain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class DomainController extends Controller
{

    public $data;

    /**
     * DomainController constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    public function datatables()
    {
        $domains = resolve('DomainService')->all();
        return DataTables::of($domains)
            ->addColumn('action', function ($domain) {
                return '<div class="btn-group btn-group-sm float-right" role="group">

                <a href="'.route('dashboard.domains.dns.index', ['domain' => $domain->domain]).'" class="btn btn-warning">
                    <i class="glyphicon glyphicon-eye"></i> Dns
                </a>
                
                <a href="'.route('dashboard.domains.show', $domain->id).'" class="btn btn-info">
                    <i class="glyphicon glyphicon-eye"></i> Ver
                </a>
                <a href="'.route('dashboard.domains.edit', $domain->id).'" class="btn btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
                <a class="btn btn-danger" href="'.route('dashboard.domains.destroy', $domain->id).'" onclick="event.preventDefault();
                    document.getElementById(\'domains-destroy-form-' . $domain->id . '\').submit();">
                    Deletar
                </a>
                <form id="domains-destroy-form-' . $domain->id . '" action="'.route('dashboard.domains.destroy', $domain->id).'" method="POST" style="display: none;">
                    <input name="_method" type="hidden" value="DELETE">    
                    <input name="_token" type="hidden" value="'. csrf_token() .'">
                    <input type="hidden" name="id" value="'.$domain->id.'">
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
    public function index()
    {
        $data['domains'] = resolve('DomainService')->all();
        return view(config('cw_domain.views', 'domain::') . 'domains.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('cw_domain.views', 'domain::') . 'domains.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomain $request)
    {
        $data = $request->all();
        $domain = resolve('DomainService')->create($data);
        $id = $domain->get('obj')->id;
        return redirect()
            ->route('dashboard.domains.edit', $id)
            ->with('status', $domain->get('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['domain'] = resolve('DomainService')->find($id);
        abort_unless($this->data['domain'], 404);
        return view(config('cw_domain.views', 'domain::') . 'domains.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomain $request, $id)
    {
        $data = $request->all();
        $domain = resolve('DomainService')->update($data, $id);
        return redirect()
            ->route('dashboard.domains.edit', $id)
            ->with('status', $domain->get('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
