<?php

namespace mi\crud\Http\Controllers\Management;

use Illuminate\Http\Request;
use mi\crud\Http\Controllers\Controller;
use mi\crud\Requests\Proxy\EditRequest;
use mi\crud\Requests\Proxy\StoreRequest;
use mi\crud\Repositories\ProxyRepository;


class ProxyController extends Controller
{
    protected $proxyRepository;
    public function __construct(ProxyRepository $proxyRepository)
    {
        $this->proxyRepository = $proxyRepository;
        $this->middleware('auth');
    }
    public function index(){
        if(!auth()->user()->is_super_user)
        {
            $data = $this->proxyRepository->findProxyByUser(auth()->user()->id);
        }else{
            $data = $this->proxyRepository->all();
        }
        return view(
            'crud::admin.proxies.index', [
            'datas'=>$data,
        ]);

    }
    public function export(){
        try {
            return $this->proxyRepository->export();
        }catch (\ErrorException $ex){
            return back()->withErrors('Something went wrong, please try again');
        }

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
