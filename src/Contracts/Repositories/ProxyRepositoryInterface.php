<?php
namespace MI\Crud\Contracts\Repositories;

use MI\Crud\Requests\Proxy\EditRequest;
use MI\Crud\Requests\Proxy\StoreRequest;

interface ProxyRepositoryInterface extends AbstractRepositoryInterface{
    public function store(StoreRequest $request, $id);
    public function update(EditRequest $request, $id);
    public function findProxyByUser($id);
}
