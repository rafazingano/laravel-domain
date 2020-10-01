<?php

namespace ConfrariaWeb\Domain\Controllers;

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
                <a href="'.route('admin.domains.show', $domain->id).'" class="btn btn-info">
                    <i class="glyphicon glyphicon-eye"></i> Ver
                </a>
                <a href="'.route('admin.domains.edit', $domain->id).'" class="btn btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Editar
                </a>
                <a class="btn btn-danger" href="'.route('admin.domains.destroy', $domain->id).'" onclick="event.preventDefault();
                    document.getElementById(\'domains-destroy-form-' . $domain->id . '\').submit();">
                    Deletar
                </a>
                <form id="domains-destroy-form-' . $domain->id . '" action="'.route('admin.domains.destroy', $domain->id).'" method="POST" style="display: none;">
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
        return view(cwView('domains.index', true), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(cwView('domains.create', true));
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
        return redirect()
            ->route('admin.domains.edit', $domain->id)
            ->with('status', __('domain.create.success'));
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
        return view(cwView('domains.edit', true), $this->data);
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
        resolve('DomainService')->update($data, $id);
        return redirect()
            ->route('admin.domains.edit', $id)
            ->with('status', trans('domain.edit.success'));
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
