<?php
namespace MI\Crud\Contracts\Repositories;


use MI\Crud\Requests\Email\EditRequest;
use MI\Crud\Requests\Email\StoreRequest;

interface EmailRepositoryInterface extends AbstractRepositoryInterface{
    public function store(StoreRequest $request, $id);
    public function update(EditRequest $request, $id);
    public function findByUserId($id);
}
