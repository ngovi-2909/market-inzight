<?php

namespace mi\crud\Http\Controllers\Management;

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
