<?php

namespace MI\Crud\Http\Controllers\Management;

use MI\Crud\Contracts\Repositories\UserRepositoryInterface;
use MI\Crud\Http\Controllers\Controller;
use MI\Crud\Requests\User\EditRequest;
use MI\Crud\Requests\User\StoreRequest;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $data = $this->userRepository->all();
        return view('Crud::admin.users.index', [
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
