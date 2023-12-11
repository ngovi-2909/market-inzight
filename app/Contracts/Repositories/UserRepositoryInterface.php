<?php
namespace App\Contracts\Repositories;

use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\StoreRequest;

interface UserRepositoryInterface extends AbstractRepositoryInterface {
    public function store(StoreRequest $request);
    public function update(EditRequest $request, $id);
    public static function getUserMailByID($id);
}
