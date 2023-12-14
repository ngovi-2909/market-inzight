<?php
namespace mi\crud\Contracts\Repositories;


use mi\crud\Contracts\Repositories\AbstractRepositoryInterface;
use mi\crud\Requests\Email\EditRequest;
use mi\crud\Requests\Email\StoreRequest;

interface EmailRepositoryInterface extends AbstractRepositoryInterface{
    public function store(StoreRequest $request, $id);
    public function update(EditRequest $request, $id);
    public function findByUserId($id);
}
