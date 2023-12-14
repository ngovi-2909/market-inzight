<?php
namespace mi\crud\Contracts\Repositories;

use mi\crud\Contracts\Repositories\AbstractRepositoryInterface;
use mi\crud\Requests\User\EditRequest;
use mi\crud\Requests\User\StoreRequest;


interface UserRepositoryInterface extends AbstractRepositoryInterface {
    public function store(StoreRequest $request);
    public function update(EditRequest $request, $id);
    public static function getUserMailByID($id);
}
