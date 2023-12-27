<?php
namespace mi\crud\Repositories;

use Maatwebsite\Excel\Facades\Excel;
use mi\crud\Contracts\Repositories\ProxyRepositoryInterface;
use mi\crud\Imports\ImportProxy;
use mi\crud\Models\Proxy;
use mi\crud\Requests\Proxy\EditRequest;
use mi\crud\Requests\Proxy\StoreRequest;
use Yajra\DataTables\DataTables;

class ProxyRepository implements ProxyRepositoryInterface{

    protected $options = ['shoppe', 'lazada', 'tiktok'];
    protected $status = ['public', 'pending', 'in-active'];

    public function getOptions(){
        return $this->options;
    }
    public function getStatus(){
        return $this->status;
    }
    public function all()
    {
        // TODO: Implement all() method.
        return Proxy::all();
    }
    public function importProxy($request){
        Excel::import(new ImportProxy(), $request->file('file')->store('files'));
    }
    public function find($id)
    {
        // TODO: Implement find() method.
        $proxy = Proxy::all();
        return $proxy->find($id);
    }

    public function destroy($id): int
    {
        // TODO: Implement destroy() method.
        return Proxy::destroy($id);
    }

    public function store(StoreRequest $request, $id): void
    {
        // TODO: Implement store() method.
        $proxy = new Proxy();
        $proxy->created_by = $id;
        $proxy->fill($request->validated());
        $proxy->save();
    }

    public function update(EditRequest $request, $id): void
    {
        // TODO: Implement update() method.
        $proxy = $this->find($id);
        $proxy->fill($request->validated());
        $proxy->save();
    }

    public function findProxyByUser($id)
    {
        // TODO: Implement findProxyByUser() method.
        return Proxy::where('created_by', $id);
    }

    public function deleteAll($request)
    {
        // TODO: Implement deleteAll() method.
        $ids = $request->ids;
        Proxy::whereIn('id',$ids)->delete();
    }

    public function dataTable(){
        return DataTables::of(Proxy::query())->make(true);
    }
}
