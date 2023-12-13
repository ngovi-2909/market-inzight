<?php

namespace MI\Crud\Http\Controllers\Management;

use MI\Crud\Http\Controllers\Controller;
use MI\Crud\Requests\Proxy\EditRequest;
use MI\Crud\Requests\Proxy\StoreRequest;
use MI\Crud\Repositories\ProxyRepository;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    protected $proxyRepository;
    public function __construct(ProxyRepository $proxyRepository)
    {
        $this->proxyRepository = $proxyRepository;
    }

    public function index(){
        if(!auth()->user()->is_super_user)
        {
            $data = $this->proxyRepository->findProxyByUser(auth()->user()->id);
        }else{
            $data = $this->proxyRepository->all();
        }
        return view(
            'Crud::admin.proxies.index', [
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
