<?php
namespace mi\crud\Repositories;

use Maatwebsite\Excel\Facades\Excel;
use mi\crud\Contracts\Repositories\ProxyRepositoryInterface;
use mi\crud\Exports\ExportProxy;
use mi\crud\Imports\ImportProxy;
use mi\crud\Models\Proxy;
use mi\crud\Requests\Proxy\EditRequest;
use mi\crud\Requests\Proxy\StoreRequest;

class ProxyRepository implements ProxyRepositoryInterface{

    protected $options = ['shoppe', 'lazada', 'tiki'];
    protected $status = ['public', 'pending', 'in-active'];

    public function getOptions(){
        return $this->options;
    }
    public function getStatus(){
        return $this->status;
    }
    public function export(){
        return Excel::download(new ExportProxy(), 'proxies_ip.xlsx');
    }
    public function all()
    {
        // TODO: Implement all() method.
        return Proxy::paginate(15);
    }
    public function importProxy($request){
        Excel::import(new ImportProxy(), $request->file('file')->store('files'));
    }
    public function find($id)
    {
        // TODO: Implement find() method.
        $proxy = $this->all();
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
        return Proxy::where('created_by', $id)->paginate(15);
    }

    public function deleteAll($request)
    {
        // TODO: Implement deleteAll() method.
        $ids = $request->ids;
        Proxy::whereIn('id',$ids)->delete();
    }
}
