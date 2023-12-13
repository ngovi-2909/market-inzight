<?php
namespace MI\Crud\Contracts\Repositories;

use MI\Crud\Requests\User\EditRequest;
use MI\Crud\Requests\User\StoreRequest;

interface UserRepositoryInterface extends AbstractRepositoryInterface {
    public function store(StoreRequest $request);
    public function update(EditRequest $request, $id);
    public static function getUserMailByID($id);
}
