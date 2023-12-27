<?php

namespace mi\crud\Http\Controllers\Management;

use Illuminate\Http\Request;
use mi\crud\Http\Controllers\Controller;
use mi\crud\Repositories\UserRepository;
use mi\crud\Requests\Email\EditRequest;
use mi\crud\Requests\Email\StoreRequest;
use mi\crud\Models\Email;
use mi\crud\Repositories\EmailRepository;
use Yajra\DataTables\DataTables;


class EmailController extends Controller
{
    protected $emailRepository;
    public function __construct(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->middleware('auth');
    }
    public function index(Request $request){

        if ($request->ajax()) {
            if(!auth()->user()->is_super_user){
                $data = $this->emailRepository->findByUserId(auth()->user()->id);
            }else{
                $data = $this->emailRepository->all();
            }
            return Datatables::of($data)
                ->editColumn('created_by', function($object){
                    return UserRepository::getUserMailByID($object->created_by);
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function(Email $email){
                    return '<input type="checkbox" name="ids" value="'.$email->id.'">';
                })
                ->addColumn('action', function(Email $email){
                    $actionBtn = '<a href="'.route('emails.edit', $email->id). '"type="button" class="btn btn-primary text-white">Edit</a>
                    <form class="forms-sample" action="'.route('emails.destroy', $email->id) . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="Submit" class="btn btn-danger text-white">Delete</button>
                    </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('crud::admin.emails.index');
    }

    public function api(){
        return $this->emailRepository->dataTable();
    }

    public function importEmail(){
        return view('crud::admin.emails.actions.import-emails');
    }
    public function import(Request $request){
        try {
            $this->emailRepository->importEmail($request);
        }catch (\ErrorException $ex){
            return back()->withErrors('Something went wrong, check your file');
        }
        return redirect(route('emails.index'));
    }
    public function deleteAll(Request $request){
        $this->emailRepository->deleteAll($request);
        return response()->json(['success'=>'Email have been deleted!']);
    }
    public function create(){
        return view('crud::admin.emails.actions.add-emails', [
            'options'=>$this->emailRepository->getOptions(),
            'status'=>$this->emailRepository->getStatus(),
        ]);
    }
    public function edit($id){
        $data = $this->emailRepository->find($id);
        return view('crud::admin.emails.actions.edit-emails', [
            'data'=>$data,
            'options'=>$this->emailRepository->getOptions(),
            'status'=>$this->emailRepository->getStatus(),
        ]);
    }

    public function store(StoreRequest $request){
        $id = auth()->user()->id;
        $this->emailRepository->store($request, $id);
        return redirect(route('emails.index'));
    }

    public function update(EditRequest $request, $id){
        $this->emailRepository->update($request, $id);
        return redirect(route('emails.index'));
    }
    public function destroy($id){
        $this->emailRepository->destroy($id);
        return redirect(route('emails.index'));
    }

}
