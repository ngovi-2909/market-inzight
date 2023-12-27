<?php

namespace mi\crud\Http\Controllers\Management;

use Illuminate\Http\Request;
use mi\crud\Contracts\Repositories\UserRepositoryInterface;
use mi\crud\Http\Controllers\Controller;
use mi\crud\Models\User;
use mi\crud\Requests\User\EditRequest;
use mi\crud\Requests\User\StoreRequest;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data = $this->userRepository->all();

        if($request->ajax()){
            return Datatables::of($data)
                ->editColumn('is_super_user', function(User $user){
                    return $user->convertTrueFalse($user->is_super_user);
                })->editColumn('is_active', function(User $user){
                    return $user->convertTrueFalse($user->is_active);
                })
                ->addIndexColumn()
                ->addColumn('action', function(User $user){
                    $actionBtn = '<a href="'.route('users.edit', $user->id). '"type="button" class="btn btn-primary text-white">Edit</a>
                    <form class="forms-sample" action="'.route('users.destroy', $user->id) . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="Submit" class="btn btn-danger text-white">Delete</button>
                    </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('crud::admin.users.index');
    }
    public function api(){
        return $this->userRepository->dataTable();
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
