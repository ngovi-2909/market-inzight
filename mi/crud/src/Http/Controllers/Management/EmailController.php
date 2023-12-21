<?php

namespace mi\crud\Http\Controllers\Management;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Exceptions\LaravelExcelException;
use Maatwebsite\Excel\Facades\Excel;
use mi\crud\Http\Controllers\Controller;
use mi\crud\Imports\ImportEmail;
use mi\crud\Requests\Email\EditRequest;
use mi\crud\Requests\Email\StoreRequest;
use mi\crud\Models\Email;
use mi\crud\Repositories\EmailRepository;
use Mockery\Exception;
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
        if(!auth()->user()->is_super_user){
            $data = $this->emailRepository->findByUserId(auth()->user()->id);
        }else{
            $data = $this->emailRepository->all();
        }
//        if ($request->ajax()) {
//            $data = Email::select('*');
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('edit', function($row){
//                    return route('emails.edit', $row);
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//        return view('crud::admin.emails.index');
        return view('crud::admin.emails.index', [
            'datas'=>$data,
        ]);
    }

    public function api(){
        return DataTables::of(Email::query())->make(true);
    }
    public function export(){
        try {
            return $this->emailRepository->export();
        }catch (\ErrorException $ex){
            return back()->withErrors('Something went wrong, check your file');
        }
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
