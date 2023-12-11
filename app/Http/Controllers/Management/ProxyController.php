<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Proxy\EditRequest;
use App\Http\Requests\Proxy\StoreRequest;
use App\Repositories\ProxyRepository;
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
            'admin.proxies.index', [
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
