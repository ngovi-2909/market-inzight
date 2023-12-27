<?php
namespace mi\crud\Repositories;

use mi\crud\Contracts\Repositories\UserRepositoryInterface;
use mi\crud\Models\User;
use mi\crud\Requests\User\EditRequest;
use mi\crud\Requests\User\StoreRequest;
use Yajra\DataTables\DataTables;

class UserRepository implements UserRepositoryInterface{

    public function all()
    {
        // TODO: Implement all() method.
        return User::all();
    }

    public function store(StoreRequest $request): void
    {
        // TODO: Implement store() method.
        $user = new User();
        $user->setCheckBoxAttribute('is_super_user', $request->get('is_super_user'));
        $user->setCheckBoxAttribute('is_active', $request->get('is_active'));
        $user->fill($request->validated());
        $user->setHashPasswordAttribute($user->password);
        $user->save();
    }

    public function update(EditRequest $request, $id): void
    {
        // TODO: Implement edit() method.
        $user = $this->find($id);
        $user->setCheckBoxAttribute('is_super_user', $request->get('is_super_user'));
        $user->setCheckBoxAttribute('is_active', $request->get('is_active'));
        $old_password = $user->password;
        $user->fill($request->validated());
        if($old_password != ($request->get('password'))){
            $user->setHashPasswordAttribute($user->password);
        }
        $user->save();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $user = User::all();
        return $user->find($id);
    }

    public function destroy($id): int
    {
        // TODO: Implement destroy() method.
        return User::destroy($id);
    }
    public static function getUserMailByID($id){
        $user = User::all();
        $user = $user->find($id);
        return $user->email;
    }
    public function dataTable(){
        return DataTables::of(User::query())->make(true);
    }
}
