<?php

namespace mi\crud\Http\Controllers\Management;

use Illuminate\Http\Request;
use mi\crud\Contracts\Repositories\UserRepositoryInterface;
use mi\crud\Http\Controllers\Controller;
use mi\crud\Models\User;
use mi\crud\Requests\User\EditRequest;
use mi\crud\Requests\User\StoreRequest;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function index(){
        $data = $this->userRepository->all();
        return view('crud::admin.users.index', [
            'datas'=>$data,
        ]);
    }

    public function edit($id){
        $data = $this->userRepository->find($id);
        return view('crud::admin.users.actions.edit-users', [
            'data'=>$data,
        ]);
    }
    public function create(){
        return view('crud::admin.users.actions.add-users');
    }
    public function store(StoreRequest $request)
    {
         $this->userRepository->store($request);
         return redirect(route('users.index'));
    }
    public function update(EditRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);
        return redirect(route('users.index'));
    }
    public function destroy($id){
        $this->userRepository->destroy($id);
        return redirect(route('users.index'));
    }

}
