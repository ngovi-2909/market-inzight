<?php
namespace App\Contracts\Repositories;


use App\Http\Requests\Email\EditRequest;
use App\Http\Requests\Email\StoreRequest;

interface EmailRepositoryInterface extends AbstractRepositoryInterface{
    public function store(StoreRequest $request, $id);
    public function update(EditRequest $request, $id);
    public function findByUserId($id);
}
