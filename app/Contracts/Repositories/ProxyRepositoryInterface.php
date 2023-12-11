<?php
namespace App\Contracts\Repositories;

use App\Http\Requests\Proxy\EditRequest;
use App\Http\Requests\Proxy\StoreRequest;
use Illuminate\Http\Request;

interface ProxyRepositoryInterface extends AbstractRepositoryInterface{
    public function store(StoreRequest $request, $id);
    public function update(EditRequest $request, $id);
}
