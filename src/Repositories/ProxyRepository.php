<?php
namespace MI\Crud\Repositories;

use MI\Crud\Contracts\Repositories\ProxyRepositoryInterface;
use MI\Crud\Models\Proxy;
use MI\Crud\Requests\Proxy\EditRequest;
use MI\Crud\Requests\Proxy\StoreRequest;

class ProxyRepository implements ProxyRepositoryInterface{

    public function all()
    {
        // TODO: Implement all() method.
        return Proxy::paginate(15);
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
        $proxy->setIsActiveAttribute($request->get('is_active'));
        $proxy->fill($request->validated());
        $proxy->save();
    }

    public function update(EditRequest $request, $id): void
    {
        // TODO: Implement update() method.
        $proxy = $this->find($id);
        $proxy->setIsActiveAttribute($request->get('is_active'));
        $proxy->fill($request->validated());
        $proxy->save();
    }

    public function findProxyByUser($id)
    {
        // TODO: Implement findProxyByUser() method.
        return Proxy::where('created_by', $id)->paginate(15);
    }
}