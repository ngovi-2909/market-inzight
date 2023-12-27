<?php

namespace mi\crud\Http\Controllers\Management;

use Illuminate\Http\Request;
use mi\crud\Http\Controllers\Controller;
use mi\crud\Models\Proxy;
use mi\crud\Repositories\UserRepository;
use mi\crud\Requests\Proxy\EditRequest;
use mi\crud\Requests\Proxy\StoreRequest;
use mi\crud\Repositories\ProxyRepository;
use Yajra\DataTables\DataTables;


class ProxyController extends Controller
{
    protected $proxyRepository;
    public function __construct(ProxyRepository $proxyRepository)
    {
        $this->proxyRepository = $proxyRepository;
        $this->middleware('auth');
    }
    public function index(Request $request){

        if($request->ajax()){
            if(!auth()->user()->is_super_user)
            {
                $data = $this->proxyRepository->findProxyByUser(auth()->user()->id);
            }else{
                $data = $this->proxyRepository->all();
            }
            return Datatables::of($data)
                ->editColumn('created_by', function($object){
                    return UserRepository::getUserMailByID($object->created_by);
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function(Proxy $proxy){
                    return '<input type="checkbox" name="ids" value="'.$proxy->id.'">';
                })
                ->addColumn('action', function(Proxy $proxy){
                    $actionBtn = '<a href="'.route('proxies.edit', $proxy->id). '"type="button" class="btn btn-primary text-white">Edit</a>
                    <form class="forms-sample" action="'.route('proxies.destroy', $proxy->id) . '" method="POST">
                        '.csrf_field().'
                        '.method_field("DELETE").'
                        <button type="Submit" class="btn btn-danger text-white">Delete</button>
                    </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('crud::admin.proxies.index');
    }

    public function api(){
        return $this->proxyRepository->dataTable();
    }
    public function deleteAll(Request $request){
        $this->proxyRepository->deleteAll($request);
        return response()->json(['success'=>'Proxy have been deleted!']);
    }
    public function importProxy(){
        return view('crud::admin.proxies.actions.import-proxies');
    }
    public function import(Request $request){
        try {
            $this->proxyRepository->importProxy($request);
        }catch (\ErrorException $ex){
            return back()->withErrors('Something went wrong, check your file');
        }
        return redirect(route('proxies.index'));
    }
    public function create(){
        return view('crud::admin.proxies.actions.add-proxies', [
            'options'=>$this->proxyRepository->getOptions(),
            'status'=>$this->proxyRepository->getStatus(),
        ]);
    }

    public function edit($id){
        $data = $this->proxyRepository->find($id);
        return view('crud::admin.proxies.actions.edit-proxies', [
            'data'=>$data,
            'options'=>$this->proxyRepository->getOptions(),
            'status'=>$this->proxyRepository->getStatus(),
        ]);
    }

    public function store(StoreRequest $request){
        $this->proxyRepository->store($request, auth()->user()->id);
        return redirect(route('proxies.index'));
    }
    public function update(EditRequest $request, $id){
        $this->proxyRepository->update($request, $id);
        return redirect(route('proxies.index'));
    }
    public function destroy($id){
        $this->proxyRepository->destroy($id);
        return redirect(route('proxies.index'));
    }
}
