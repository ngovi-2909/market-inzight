<?php
namespace mi\crud\Contracts\Repositories;

use mi\crud\Contracts\Repositories\AbstractRepositoryInterface;
use mi\crud\Requests\Proxy\EditRequest;
use mi\crud\Requests\Proxy\StoreRequest;

interface ProxyRepositoryInterface extends AbstractRepositoryInterface{
    public function store(StoreRequest $request, $id);
    public function update(EditRequest $request, $id);
    public function findProxyByUser($id);
}
