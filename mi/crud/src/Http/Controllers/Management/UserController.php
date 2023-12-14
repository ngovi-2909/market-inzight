<?php

namespace mi\crud\Http\Controllers\Management;

use mi\crud\Contracts\Repositories\UserRepositoryInterface;
use mi\crud\Http\Controllers\Controller;
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

    public function store(StoreRequest $request)
    {
         $this->userRepository->store($request);
         return redirect(route('users.index'));
    }
    public function update(EditRequest $request, $id)
    {
        $this->userRepository->update($request, $id);
        return redirect(route('users.index'));
    }
    public function destroy($id){
        $this->userRepository->destroy($id);
        return redirect(route('users.index'));
    }

}
